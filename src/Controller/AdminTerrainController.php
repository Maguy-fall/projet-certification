<?php

namespace App\Controller;

use App\Form\AdminTerrainType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTerrainController extends AbstractController
{
    /**
     * @Route("/admin/terrain/create", name="admin_terrain_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminTerrainType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $terrain = $form->getData();
            $entityManager->persist($terrain);
            $entityManager->flush();

            return $this->redirectToRoute('admin_terrain');
        }

        return $this->render('admin_terrain/create.html.twig', [
            'controller_name' => 'AdminTerrainController',
            'form' => $form->createView()
        ]);
    }
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

