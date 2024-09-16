<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Stock;
use App\Entity\SweatShirts;
use App\Form\CartType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function cart(EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);

        if (!$cart || $cart->getItems()->isEmpty()) {
            return $this->render('cart/empty.html.twig');
        }


        return $this->render('cart/index.html.twig', ['items' => $cart->getItems(), 'cart' => $cart]);
    }

    #[Route('/product/{id}/add', name: 'add_to_cart')]

    public function addToCart(EntityManagerInterface $entityManager, Security $security, int $id, Request $request): Response
    {
        $user = $security->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);


        if (!$cart) {

            $cart = new Cart($user);
            $entityManager->persist($cart);
        }

        $sweatshirt = $entityManager->getRepository(SweatShirts::class)->find($id);
        $stockId = $request->request->get('size');
        $stock = $entityManager->getRepository(Stock::class)->find($stockId);
        $cartItem = $entityManager->getRepository(CartItem::class)->findOneBy([
            'cart' => $cart,
            'sweatshirt' => $sweatshirt
        ]);

        if ($cartItem) {

            $cartItem->setQuanity($cartItem->getQuantity() + 1);
        } else {

            $cartItem = new CartItem();
            $cartItem->setSweatshirt($sweatshirt);
            $cartItem->setStock($stock);
            $cartItem->setQuantity(1);
            $cartItem->setCart($cart);
            $entityManager->persist($cartItem);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_cart');
    }
}
