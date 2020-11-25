<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminVillaController extends AbstractController
{
    /**
     * @Route("/admin/villa", name="admin_villa")
     */
    public function index(): Response
    {
        return $this->render('admin_villa/index.html.twig', [
            'controller_name' => 'AdminVillaController',
        ]);
    }
}
