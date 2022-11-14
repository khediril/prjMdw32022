<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/add/{nom}/{prix}/{quantite}", name="app_produit_add")
     */
    public function add($nom,$prix,$quantite): Response
    {
        $produit = new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setQuantite($quantite);
        $this->getDoctrine()->getRepository(Produit::class)->add($produit,true);
        /*$em = $this->getDoctrine()->getManager();
        
        $em->persist($produit);
        $em->flush();*/

        return $this->render('produit/add.html.twig', [
            'produit' => $produit,
        ]);
    }
   
    /**
     * @Route("/produit/list", name="app_produit_list")
     */
    public function list(): Response
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)
        ->findAll();   

        return $this->render('produit/list.html.twig', ['produits'=> $produits
            
        ]);
    }
     /**
     * @Route("/produit/{id}", name="app_produit_lire")
     */
    public function lireProduit($id): Response
    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)
        ->find($id);  
        if($produit)
                return $this->render('produit/read.html.twig', ['produit'=> $produit ]);
        else
                return $this->render('produit/error.html.twig', ['msg'=> 'Aucun produit ayant ce id' ]);
                
       
    }
}
