<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Advert;
use App\Form\AdvertType;
use App\Repository\AdvertRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\StringType;

/**
    * @Route("/home", name="home_")
    */
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(AdvertRepository $advertRepository): Response
    {
        $lastAdverts = $advertRepository->findLastAdverts();
        return $this->render('home/index.html.twig', [
            'lastAdverts' => $lastAdverts,
            'categories' => Advert::$CATEGORIES,
            'regions' => Advert::$REGIONS,
            'brands' => Advert::$BRANDS,
        ]);
    }
    /**
     * @Route("/show", name="show")
     */
    public function show(AdvertRepository $advertRepository): Response
    {
        $adverts = [];
        if (!empty($_POST)) {
            $category = $_POST['categories'];
            $brand = $_POST['brands'];
            $description = $_POST['mot-cles'];
            $region = $_POST['region'];
            $adverts = $advertRepository->findBySomeField($category, $brand, $description, $region);
        }
        return $this->render('home/show.html.twig', [
            'adverts' => $adverts
        ]);
    }
}
