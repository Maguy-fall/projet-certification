<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Entity\Image;
use App\Form\AppartementType;
use App\Repository\AppartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/appartement")
 */
class AppartementController extends AbstractController
{
    /**
     * @Route("/", name="appartement_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(AppartementRepository $appartementRepository): Response
    {
        return $this->render('appartement/index.html.twig', [
            'appartements' => $appartementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="appartement_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $appartement = new Appartement();
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photoFile = $form->get('photo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $photo = new Image(); 
                $photo->setImagefilename($newFilename);
                $photo->setAppartement($appartement);
                $entityManager->persist($photo);

            }

            
            $entityManager->persist($appartement);
            $entityManager->flush();

            dump($appartement);die;

            return $this->redirectToRoute('appartement_index');
        }

        return $this->render('appartement/new.html.twig', [
            'appartement' => $appartement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appartement_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Appartement $appartement): Response
    {
        return $this->render('appartement/show.html.twig', [
            'appartement' => $appartement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="appartement_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Appartement $appartement): Response
    {
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appartement_index');
        }

        return $this->render('appartement/edit.html.twig', [
            'appartement' => $appartement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appartement_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Appartement $appartement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appartement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appartement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('appartement_index');
    }
}
