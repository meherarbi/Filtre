<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Product;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create('fr_FR');
         $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker)); 
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        
       
          $product = [];
        for ($i = 0; $i < 50; $i++) {
             $product[$i] = new Product();
            $product[$i]->setName($faker->productName);
            $product[$i]->setPrice($faker->numberBetween($min = 50, $max = 6000));
            $product[$i]->setDescription($faker->text(100));
            $product[$i]->setImage($faker->imageUrl(500, 240,true));
            $product[$i]->setPromo('10%? 1 : 0');
        
        
            $manager->persist($product[$i]);

            $manager->flush();
        }
    }
}
