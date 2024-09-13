<?php

namespace App\Controller;

use App\Entity\SweatShirts;
use App\Form\DeleteSweatType;
use App\Form\SweatShirtType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SweatShirtController extends AbstractController
{
    #[Route('/product', name: 'app_all_product')]
    public function AllProduct(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(SweatShirts::class)->findAll();


        return $this->render('sweat_shirt/all_product.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'app_one_product')]
    public function OneProduct(ManagerRegistry $manager, int $id): Response
    {
        $product = $manager->getRepository(SweatShirts::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        return $this->render('sweat_shirt/one_product.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, EntityManagerInterface $entityManager, int $id, FileUploader $fileUploader): Response
    {
        $product = $entityManager->getRepository(SweatShirts::class)->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No SweatShirt found for id ' . $id);
        }

        $form = $this->createForm(SweatShirtType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $product->setImageFilename($imageFileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('back_office');
        }
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

            return $this->redirectToRoute('back_office');
        }
    }
}
