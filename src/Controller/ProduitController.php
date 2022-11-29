<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/add/{nom}/{prix}/{quantite}", name="app_produit_add")
     */
    public function add($nom, $prix, $quantite): Response
    {
        $produit = new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setQuantite($quantite);
        $this->getDoctrine()->getRepository(Produit::class)->add($produit, true);
        /*$em = $this->getDoctrine()->getManager();

        $em->persist($produit);
        $em->flush();*/

        return $this->render('produit/add.html.twig', [
            'produit' => $produit,
        ]);
    }
    /**
     * @Route("/produit/add2", name="app_produit_add2")
     */
    public function add2(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
       
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $produit = $form->getData();
            $this->getDoctrine()
                 ->getRepository(Produit::class)
                 ->save($produit, true);
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_produit_list');
        }
       
        return $this->renderForm('produit/add2.html.twig', [
            'maform' => $form,
        ]);

        /*  $produit = new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setQuantite($quantite);*/
        $this->getDoctrine()->getRepository(Produit::class)->add($produit, true);
        /*$em = $this->getDoctrine()->getManager();

        $em->persist($produit);
        $em->flush();*/

      /*  return $this->render('produit/add.html.twig', [
            'produit' => $produit,
        ]);*/
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
        if ($produit) {
            return $this->render('produit/read.html.twig', ['produit'=> $produit ]);
        } else {
            return $this->render('produit/error.html.twig', ['msg'=> 'Aucun produit ayant ce id' ]);
        }
    }
    /**
     * @Route("/produit/delete/{id}", name="app_produit_delete")
     */
    public function delete($id): Response
    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)
        ->find($id);
        if ($produit) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
            return $this->render('produit/delete.html.twig', ['id'=> $id ]);
        } else {
            return $this->render('produit/error.html.twig', ['msg'=> 'Aucun produit ayant ce id' ]);
        }
    }
     /**
     * @Route("/produit/update/{id}/{nprix}", name="app_produit_update")
     */
    public function update($id,$nprix,ProduitRepository $repo): Response
    {
      //  $produit = $this->getDoctrine()->getRepository(Produit::class)
      //  ->find($id);
      $produit = $repo->find($id);
        if ($produit) {
            $produit->setPrix($nprix);
            //Metode 1
                // $em = $this->getDoctrine()->getManager();
                // $em->remove($produit);
                // $em->flush();
            //Methode 2
            $repo->save($produit,true);
            return $this->redirectToRoute('app_produit_list');
        } else {
            return $this->render('produit/error.html.twig', ['msg'=> 'Aucun produit ayant ce id' ]);
        }
    }
}
