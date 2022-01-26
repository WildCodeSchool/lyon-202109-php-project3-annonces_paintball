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
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/show", name="show")
     */
    public function show(AdvertRepository $advertRepository, UserRepository $userRepository): Response
    {
        $adverts = [];
        if (!empty($_POST)) {
            $category = $_POST['categories'];
            $brand = $_POST['brands'];
            $description = $_POST['mot-cles'];
            $postalCode = $_POST['region'];
            $adverts = $advertRepository->findBySomeField($category, $brand, $description);
            $adverts = $userRepository->findOneBySomeField($postalCode);
        }
        return $this->render('home/show.html.twig', [
            'adverts' => $adverts
        ]);
    }
}
