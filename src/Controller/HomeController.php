<?php

namespace App\Controller;

use App\Repository\MaisonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MaisonsRepository $maisonsRepository)
    {
        $maisons = $maisonsRepository->findThree();

        return $this->render('home/index.html.twig', [
            'maisons' => $maisons,
        ]);
    }
}