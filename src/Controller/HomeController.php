<?php

namespace App\Controller;

use App\Entity\SweatShirts;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(SweatShirts::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();

        return $this->render('home/index.html.twig', [
            'users' => $users,
            'products' => $products
        ]);
    }
}
