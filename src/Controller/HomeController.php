<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Advert;
use App\Repository\AdvertRepository;
use Doctrine\DBAL\Types\StringType;

/**
    * @Route("/home", name="home_")
    */
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/show", name="show")
     */
    public function show(): Response
    {
        $adverts = $this->getDoctrine()
        ->getRepository(Advert::class)
        ->findAll();
        return $this->render('home/show.html.twig', [
            'adverts' => $adverts
        ]);
    }
}
