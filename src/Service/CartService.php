<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\SweatShirts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CartService
{
  private $entityManager;
  private $user;
  private $sweatShirt;

  public function __construct(EntityManagerInterface $entityManager, Security $security, SweatShirts $sweatShirt)
  {
    $this->entityManager = $entityManager;
    $this->user = $security->getUser();
    $this->sweatShirt = $sweatShirt;
  }

  public function getCartItems()
  {
    $cart = $this->entityManager->getRepository(Cart::class)->findOneBy(['user' => $this->user]);

    return $this->entityManager->getRepository(CartItem::class)
      ->findBy([
        'cart' => $cart,
        'sweatshirt' => $this->sweatShirt
      ]);
  }

  public function addToCart(SweatShirts $sweatShirt, $stock)
  {
    $cart = $this->entityManager->getRepository(Cart::class)->findOneBy(['user' => $this->user]);
    $cartItem = $this->entityManager->getRepository(CartItem::class)->findOneBy([
      'cart' => $cart,
      'sweatshirt' => $sweatShirt
    ]);


    if (!$cart) {

      $cart = new Cart($this->user);
      $this->entityManager->persist($cart);
    }

    if ($cartItem) {

      $cartItem->setQuantity($cartItem->getQuantity() + 1);
    } else {

      $cartItem = new CartItem();
      $cartItem->setSweatshirt($sweatShirt);
      $cartItem->setStock($stock);
      $cartItem->setQuantity(1);
      $cartItem->setCart($cart);
      $this->entityManager->persist($cartItem);
    }

    $this->entityManager->flush();
  }

  public function removeFromCart(CartItem $cartItem)
  {
    $this->entityManager->remove($cartItem);
    $this->entityManager->flush();
  }

  public function clearCart()
  {
    $cartItems = $this->getCartItems();

    foreach ($cartItems as $item) {
      $this->entityManager->remove($item);
    }

    $this->entityManager->flush();
  }
}
