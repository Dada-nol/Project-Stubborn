<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Stock;
use App\Entity\SweatShirts;
use App\Entity\TailleSweat;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
  public function testAddCartItemToCart()
  {
    $user = new User();
    $user->setName('Darren');
    $user->setEmail('dada@gmail.com');
    $user->setPassword('gsd15');

    $sweatshirt = new SweatShirts();
    $sweatshirt->setName('Test Product');
    $sweatshirt->setPrice(1000);

    $size = new TailleSweat();
    $size->setSize('M');

    $stock = new Stock();
    $stock->setSweatShirt($sweatshirt);
    $stock->setSize($size);
    $stock->setquantity(5);

    $cart = new Cart($user);

    $cartItem = new CartItem();
    $cartItem->setSweatShirt($sweatshirt);
    $cartItem->setQuantity(2);
    $cartItem->setStock($stock);

    $cart->addItem($cartItem);

    $items = $cart->getItems();

    $this->assertCount(1, $items);

    $this->assertSame($cartItem, $items[0]);

    $this->assertSame($sweatshirt, $items[0]->getSweatshirt());

    $this->assertEquals(2, $items[0]->getQuantity());
  }
}
