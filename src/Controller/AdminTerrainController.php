<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTerrainController extends AbstractController
{
    /**
     * @Route("/admin/terrain", name="admin_terrain")
     */
    public function index(): Response
    {
        return $this->render('admin_terrain/index.html.twig', [
            'controller_name' => 'AdminTerrainController',
        ]);
    }
}
