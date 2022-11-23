<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <20 ; $i++) { 
            $produit = new Produit();
        $produit->setNom("Produit"+$i);
        $produit->setPrix(mt_rand(1000, 5000));
        $produit->setQuantite(mt_rand(1, 100));
        $manager->persist($produit);
        }
        $manager->flush();
    }
}
