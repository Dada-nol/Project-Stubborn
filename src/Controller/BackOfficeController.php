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

#[Route('/back_office')]
class BackOfficeController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(Request $request, ManagerRegistry $manager, FileUploader $fileUploader): Response
    {
        $product = new SweatShirts();

        $sizes = $manager->getRepository(TailleSweat::class)->findAll();

        foreach ($sizes as $size) {
            $stock = new Stock();
            $stock->setSize($size);
            $product->addStock($stock);
        }

        $form = $this->createForm(SweatShirtType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $product->setImageFilename($imageFileName);
            }

            $save = $manager->getManager();
            $save->persist($product);
            $save->flush();

            return $this->redirectToRoute('app_all_product');
        }

        return $this->render('back_office/index.html.twig', ['productForm' => $form->createView()]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, EntityManagerInterface $entityManager, int $id, FileUploader $fileUploader): Response
    {
        $product = $entityManager->getRepository(SweatShirts::class)->find($id);

        $form = $this->createForm(SweatShirtType::class, $product);

        if (!$product) {
            throw $this->createNotFoundException(
                'No SweatShirt found for id' . $id
            );
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $product->setImageFilename($imageFileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_one_product', ['id' => $product->getId()]);
        }

        return $this->render('back_office/index.html.twig', ['productForm' => $form->createView(),]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(SweatShirts::class)->find($id);
        $form = $this->createForm(DeleteSweatType::class, $product);

        if (!$product) {
            throw $this->createNotFoundException(
                'No SweatShirt found for id' . $id
            );
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->remove($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_all_product');
        }

        return $this->render('back_office/delete.html.twig', ['deleteSweatShirt' => $form->createView(),]);
    }
}
