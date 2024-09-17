<?php

namespace App\Controller;

use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
    public function checkout(EntityManagerInterface $entityManager, Security $security): Response
    {

        $user = $security->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);

        if ($user instanceof \App\Entity\User) {

            $userName = $user->getName();
        } else {

            $userName = 'Utilisateur inconnu';
        }

        Stripe::setApiKey('sk_test_51PzlqFA8JVhfe8ThMyYDJemgtdjSTIj5378UAy55ksSPOgZkCT7DrXil5TTqcjfSzW3EC8paDZpjJADXncN9bcsw001TANttsi');

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Panier de' . ' ' . $userName,
                    ],
                    'unit_amount' => $cart->getTotal() * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($checkout_session->url, 303);
    }

    #[Route('/payment/success', name: 'payment_success')]
    public function paymentSuccess(Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = $security->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);
        $cartItems = $cart->getItems();

        foreach ($cartItems as $item) {
            $stock = $item->getStock();
            $quantityPurchased = $item->getQuantity();

            if ($stock) {

                $stock->setQuantity($stock->getQuantity() - $quantityPurchased);
                $entityManager->persist($stock);
            }
            $entityManager->remove($item);
        }


        $entityManager->flush();

        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment/cancel', name: 'payment_cancel')]
    public function paymentCancel(): Response
    {
        return $this->render('payment/cancel.html.twig');
    }
}
