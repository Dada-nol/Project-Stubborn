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

  public function __construct(EntityManagerInterface $entityManager, Security $security)
  {
    $this->entityManager = $entityManager;
    $this->user = $security->getUser();
  }

  // Récupérer les articles du panier
  public function getCartItems(SweatShirts $sweatShirt)
  {

    $cart = $this->entityManager->getRepository(Cart::class)->findOneBy(['user' => $this->user]);


    return $this->entityManager->getRepository(CartItem::class)
      ->findBy([
        'cart' => $cart,
        'sweatshirt' => $sweatShirt
      ]);
  }

  // Ajouter un article au panier
  public function addToCart(SweatShirts $sweatShirt, $stock)
  {
    // Vérifier si l'article existe déjà dans le panier
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

    // Sauvegarder en base de données
    $this->entityManager->flush();
  }

  // Supprimer un article du panier
  public function removeFromCart(CartItem $cartItem)
  {
    $this->entityManager->remove($cartItem);
    $this->entityManager->flush();
  }

  // Vider le panier
  public function clearCart(SweatShirts $sweatShirt)
  {
    $cartItems = $this->getCartItems($sweatShirt);

    foreach ($cartItems as $item) {
      $this->entityManager->remove($item);
    }

    $this->entityManager->flush();
  }
}
