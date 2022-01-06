<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     */
    public function index(): Response
    {
        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findAll();

        return $this->render('annonces/index.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/annonce/{id}", name="annonce_show", methods="GET")
     */
    public function show(Annonce $annonce): Response
    {
        $marques = $annonce->getMarque();
        $modele = $annonce->getModele();
        $titre = $annonce->getTitre();
        $prix = $annonce->getPrix();
        $etat = $annonce->getEtat();
        $description = $annonce->getDescription();
        $photos = $annonce->getPhotos();

        return $this->render('annonces/show.html.twig', [
            'marque' => $marques, 'modele' => $modele, 'titre' => $titre,'prix' => $prix,
             'etat' => $etat, 'description' => $description, 'photos' => $photos,
        ]);
    }
}
