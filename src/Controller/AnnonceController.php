<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AnnonceType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce_index")
     */
    public function index(): Response
    {
        $annonces = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findAll();
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonces]);
    }
    /**
     * @Route("/annonce/new", name="new")
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        // Create a new Annonce Object
        $annonce = new Annonce();
        // Create the associated Form
        $form = $this->createForm(AnnonceType::class, $annonce);
        // Get data from HTTP request
        $form->handleRequest($request);
         // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $user = $userRepository->find(1);
            $annonce->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            // Persist Annonce Object
            $entityManager->persist($annonce);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to annonce list
            return $this->redirectToRoute('annonce_index');
        }
        return $this->render('annonce/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
