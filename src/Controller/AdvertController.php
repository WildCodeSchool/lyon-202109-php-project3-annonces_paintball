<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/{id}", name="show", requirements={"id"="\d+"})
     */
    public function advertShow(): Response
    {
        return $this->render('advert/index.html.twig', [
            'controller_name' => 'AdvertController',
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
