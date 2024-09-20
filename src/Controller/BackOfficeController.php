<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Service\FileUploader;
use App\Entity\SweatShirts;
use App\Entity\TailleSweat;
use App\Form\DeleteSweatType;
use App\Form\SweatShirtType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BackOfficeController extends AbstractController
{

    #[Route('/admin', name: "back_office")]
    public function backOffice(Request $request, ManagerRegistry $manager, FileUploader $fileUploader, EntityManagerInterface $entityManager): Response
    {

        $product = new SweatShirts();
        $sizes = $manager->getRepository(TailleSweat::class)->findAll();

        foreach ($sizes as $size) {
            $stock = new Stock();
            $stock->setSize($size);
            $product->addStock($stock);
        }

        $addForm = $this->createForm(SweatShirtType::class, $product);

        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {

            $imageFile = $addForm->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $product->setImageFilename($imageFileName);
            }

            $save = $manager->getManager();
            $save->persist($product);
            $save->flush();

            return $this->redirectToRoute('back_office');
        }

        $sweats = $entityManager->getRepository(SweatShirts::class)->findAll();


        $updateForms = [];
        $deleteForms = [];

        foreach ($sweats as $sweat) {

            $updateForm = $this->createForm(SweatShirtType::class, $sweat, [
                'action' => $this->generateUrl('update', ['id' => $sweat->getId()]),

            ]);


            $updateForms[$sweat->getId()] = $updateForm->createView();


            $deleteForm = $this->createForm(DeleteSweatType::class, $sweat, [
                'action' => $this->generateUrl('delete', ['id' => $sweat->getId()]),

            ]);


            $deleteForms[$sweat->getId()] = $deleteForm->createView();
        }
        return $this->render('back_office/index.html.twig', ['addForm' => $addForm->createView(), 'updateForms' => $updateForms, 'deleteForms' => $deleteForms, 'products' => $sweats]);
    }
}
