<?php

namespace App\Controller;

use App\Repository\TerrainRepository;
use App\Repository\AppartementRepository;
use App\Repository\VillaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcheterController extends AbstractController
{
    /**
     * @Route("/acheter", name="acheter")
     */
    public function index(AppartementRepository $appartementRepository, TerrainRepository $terrainRepository, VillaRepository $villaRepository)
    {
        $appartement = $appartementRepository->findAll();
        $terrain = $terrainRepository->findAll();
        $villa = $villaRepository->findAll();

        return $this->render('acheter/index.html.twig', [
            'appartement' => $appartement,
            'terrain' => $terrain,
            'villa' => $villa,
        ]);
    }
}
    