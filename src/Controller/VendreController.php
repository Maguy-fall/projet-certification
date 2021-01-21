<?php

namespace App\Controller;

use App\Form\VendreType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VendreController extends AbstractController
{
    /**
     * @Route("/vendre", name="vendre")
     */
    public function index(\Swift_Mailer $mailer, Request $request)
    {
        $formulaireVendre = $this->createForm(VendreType::class);
        $formulaireVendre->handleRequest($request);

        if($formulaireVendre->isSubmitted() && $formulaireVendre->isValid()){
            $infos = $formulaireVendre->getData();
            $mail = (new \Swift_Message('CADEXGROUP - demande de contact'))
                ->setFrom($infos['email'])
                ->setTo('maiga.falle@gmail.com')
                ->setBody(
                    $this->renderView(
                        'vendre/email.html.twig', [
                            'nom' => $infos['nom'],
                            'numero_de_telephone' => $infos['numero_de_telephone'],
                            'email' => $infos['email'],
                            'message' => $infos['message']
                        ],
                        'text/html'
                    )
                );
            $mailer->send($mail);
            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'

            );
            return $this->redirectToRoute('home');
        }

        return $this->render('vendre/index.html.twig', [
            'formulaireVendre' => $formulaireVendre->createView(),
        ]);
    }
}
