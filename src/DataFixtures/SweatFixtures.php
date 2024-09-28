<?php

namespace App\DataFixtures;

use App\Entity\Stock;
use App\Entity\SweatShirts;
use App\Entity\TailleSweat;
use App\Service\FileUploader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SweatFixtures extends Fixture
{

  public function load(ObjectManager $manager): void
  {

    $sizes = ['XS', 'S', 'M', 'L', 'XL'];
    $sizeLabel = [];

    foreach ($sizes as $sizeName) {
      $size = new TailleSweat();
      $size->setSize($sizeName);

      $manager->persist($size);
      $sizeLabel[$sizeName] = $size;
    }

    $sweatshirtData = [
      [
        'name' => 'Blackbelt',
        'price' => 29.90,
        'isPromoted' => false,
        'ImageFilename' => 'Blackbelt-66e4a04503ee7.jpg',
      ],

      [
        'name' => 'BlueBelt',
        'price' => 29.90,
        'isPromoted' => false,
        'ImageFilename' => 'BlueBelt-66e0564b83101.jpg',
      ],

      [
        'name' => 'Street',
        'price' => 34.50,
        'isPromoted' => false,
        'ImageFilename' => 'Street-66e49fd889572.jpg',
      ],

      [
        'name' => 'Pokeball',
        'price' => 45.00,
        'isPromoted' => true,
        'ImageFilename' => 'Pokeball-66e337337a217.jpg',
      ],

      [
        'name' => 'PinkLady',
        'price' => 29.90,
        'isPromoted' => false,
        'ImageFilename' => 'PinkLady-66e49ef2923eb.jpg',
      ],

      [
        'name' => 'Snow',
        'price' => 32.00,
        'isPromoted' => false,
        'ImageFilename' => 'Snow-66e7db557188c.jpg',
      ],

      [
        'name' => 'Greyback',
        'price' => 28.50,
        'isPromoted' => false,
        'ImageFilename' => 'Greyback-66e49f2ed19e0.jpg',
      ],

      [
        'name' => 'BlueCloud',
        'price' => 45.00,
        'isPromoted' => false,
        'ImageFilename' => 'BlueCloud-66e49f4c00449.jpg',
      ],

      [
        'name' => 'BornInUsa',
        'price' => 59.90,
        'isPromoted' => true,
        'ImageFilename' => 'BornInUsa-66e49f6980f4d.jpg',
      ],

      [
        'name' => 'GreenSchool',
        'price' => 42.20,
        'isPromoted' => true,
        'ImageFilename' => 'GreenSchool-66e49f804221a.jpg',
      ],

    ];

    foreach ($sweatshirtData as $data) {
      $sweatshirt = new SweatShirts();
      $sweatshirt->setName($data['name']);
      $sweatshirt->setPrice($data['price']);
      $sweatshirt->setisPromoted($data['isPromoted']);
      $sweatshirt->setImageFilename($data['ImageFilename']);

      $manager->persist($sweatshirt);



      foreach ($sizeLabel as $size) {
        $stock = new Stock();
        $stock->setSize($size);
        $stock->setSweatShirt($sweatshirt);
        $stock->setquantity(2);

        $manager->persist($stock);
      }
    }

    $manager->flush();
  }
}
