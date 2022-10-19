<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/asslema", name="app_asslema")
     */
    public function asslama(): Response
    {
        $rep = $this->render('test/asslema.html.twig', [
            'controller_name' => 'TestController:asslema',
        ]);
        return $rep;
    }
    /**
     * @Route("/test", name="app_test")
     */
    public function test(): Response
    {
        $noms=["lina","Amine","mourad","Mahmoud","Sameh"];
        
        $rep = $this->render('test/test.html.twig', ["names"=>$noms        ]);
        return $rep;
    }
     /**
     * @Route("/{name}", name="app_test2")
     */
    public function test2($name): Response
    {
        $nom = strtoupper($name); 
        
        $rep = $this->render('test/test2.html.twig', ["nom"=>$nom        ]);
        return $rep;
    }
    /**
     * @Route("/somme/{nb1}/{nb2}", name="app_somme")
     */
    public function somme($nb1,$nb2): Response
    {
        $somme = $nb1 + $nb2; 
        
        $rep = $this->render('test/somme.html.twig', ["a"=>$nb1,"b"=>$nb2,"somme"=>$somme        ]);
        return $rep;
    }

}
