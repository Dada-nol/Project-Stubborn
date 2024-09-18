<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Stock;
use App\Entity\SweatShirts;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/cart', name: 'cart')]
    public function showCart(EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);
        return $this->render('cart/index.html.twig', ['items' => $cart->getItems(), 'cart' => $cart]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function addToCart(EntityManagerInterface $entityManager, int $id, SweatShirts $sweatshirt, Request $request): Response
    {
        $sweatshirt = $entityManager->getRepository(SweatShirts::class)->find($id);
        $stockId = $request->request->get('size');
        $stock = $entityManager->getRepository(Stock::class)->find($stockId);

        $this->cartService->addToCart($sweatshirt, $stock);

        return $this->redirectToRoute('cart');
    }
}
