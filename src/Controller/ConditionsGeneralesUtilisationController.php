<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionsGeneralesUtilisationController extends AbstractController
{
    /**
     * @Route("/conditions/generales/utilisation", name="conditions_generales_utilisation")
     */
    public function index(): Response
    {
        return $this->render('conditions_generales_utilisation/index.html.twig', [
            'controller_name' => 'ConditionsGeneralesUtilisationController',
        ]);
    }
}
