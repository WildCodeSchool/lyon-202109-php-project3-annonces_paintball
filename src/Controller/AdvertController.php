<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdvertType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/advert", name="advert_")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function advertAdd(): Response
    {
        return $this->render('advert/index.html.twig', [
            'controller_name' => 'AdvertController',
        ]);
    }
/**
     * @Route("/new", name="new")
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        // Create a new Annonce Object
        $advert = new Advert();
        // Create the associated Form
        $form = $this->createForm(AdvertType::class, $advert);
        // Get data from HTTP request
        $form->handleRequest($request);
         // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $user = $userRepository->find(1);
            $advert->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            // Persist Annonce Object
            $entityManager->persist($advert);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to annonce list
            return $this->redirectToRoute('advert_add');
        }
        return $this->render('advert/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="show", requirements={"id"="\d+"})
     */
    public function advertShow(Advert $advert): Response
    {
        return $this->render('advert/index.html.twig', [
            'advert' => $advert,
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function advertSearch(): Response
    {
        return $this->render('advert/index.html.twig', []);
    }
}
