<?php

namespace App\Controller;

use App\Form\AdminAppartementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAppartementController extends AbstractController
{
    /**
     * @Route("/admin/appartement/create", name="admin_appartement_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminAppartementType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $appartement = $form->getData();
            $entityManager->persist($appartement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_appartement');
        }

        return $this->render('admin_appartement/create.html.twig', [
            'controller_name' => 'AdminAppartementController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/appartement", name="admin_appartement")
     */
    public function index(): Response
    {
        return $this->render('admin_appartement/index.html.twig', [
            'controller_name' => 'AdminAppartementController',
        ]);
    }
}
