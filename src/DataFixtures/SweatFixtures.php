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
        'ImageFilename' => 'Blackbelt.jpeg',
      ],

      [
        'name' => 'BlueBelt',
        'price' => 29.90,
        'isPromoted' => false,
        'ImageFilename' => 'BlueBelt.jpeg',
      ],

      [
        'name' => 'Street',
        'price' => 34.50,
        'isPromoted' => false,
        'ImageFilename' => 'Street.jpeg',
      ],

      [
        'name' => 'Pokeball',
        'price' => 45.00,
        'isPromoted' => true,
        'ImageFilename' => 'Pokeball.jpeg',
      ],

      [
        'name' => 'PinkLady',
        'price' => 29.90,
        'isPromoted' => false,
        'ImageFilename' => 'PinkLady.jpeg',
      ],

      [
        'name' => 'Snow',
        'price' => 32.00,
        'isPromoted' => false,
        'ImageFilename' => 'Snow.jpeg',
      ],

      [
        'name' => 'Greyback',
        'price' => 28.50,
        'isPromoted' => false,
        'ImageFilename' => 'Greyback.jpeg',
      ],

      [
        'name' => 'BlueCloud',
        'price' => 45.00,
        'isPromoted' => false,
        'ImageFilename' => 'BlueCloud.jpeg',
      ],

      [
        'name' => 'BornInUsa',
        'price' => 59.90,
        'isPromoted' => true,
        'ImageFilename' => 'BornInUsa.jpeg',
      ],

      [
        'name' => 'GreenSchool',
        'price' => 42.20,
        'isPromoted' => true,
        'ImageFilename' => 'GreenSchool.jpeg',
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
