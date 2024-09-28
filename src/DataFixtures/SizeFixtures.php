<?php

namespace App\DataFixtures;

use App\Entity\TailleSweat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{

  public function load(ObjectManager $manager): void
  {
    $sizes = ['XS', 'S', 'M', 'L', 'XL'];

    foreach ($sizes as $sizeLabel) {
      $size = new TailleSweat();
      $size->setSize($sizeLabel);
      $manager->persist($size);
    }



    $manager->flush();
  }
}
