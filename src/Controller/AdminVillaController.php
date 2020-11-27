<?php

namespace App\Controller;

use App\Form\AdminVillaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminVillaController extends AbstractController
{
    /**
     * @Route("/admin/villa/create", name="admin_villa_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminVillaType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $villa = $form->getData();
            $entityManager->persist($villa);
            $entityManager->flush();

            return $this->redirectToRoute('admin_villa');
        }

        return $this->render('admin_villa/create.html.twig', [
            'controller_name' => 'AdminVillaController',
            'form' => $form->createView()
        ]);
    }
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
