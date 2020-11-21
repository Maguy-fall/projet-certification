<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminRendezvousController extends AbstractController
{
    /**
     * @Route("/admin/rendezvous", name="admin_rendezvous")
     */
    public function index(): Response
    {
        return $this->render('admin_rendezvous/index.html.twig', [
            'controller_name' => 'AdminRendezvousController',
        ]);
    }
}
