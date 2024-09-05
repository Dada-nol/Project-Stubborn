<?php

namespace App\Controller;

use App\Entity\SweatShirts;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SweatShirtController extends AbstractController
{
    #[Route('/product', name: 'app_all_product')]
    public function AllProduct(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(SweatShirts::class)->findAll();


        return $this->render('all_product.html.twig', [
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

        return $this->render('one_product.html.twig', [
            'product' => $product,
        ]);
    }
}
