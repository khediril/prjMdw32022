<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route("/new", name="app_new")
     */
    public function index(): Response
    {
        return $this->render('new/index.html.twig', [
            'controller_name' => 'NewController',
        ]);
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function about(): Response
    {
        return $this->render('new/about.html.twig', [
        ]);
    }
    /**
     * @Route("/services", name="app_services")
     */
    public function services(): Response
    {
        return $this->render('new/services.html.twig', [
        ]);
    }
}
