<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AdvertRepository;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/adverts", name="adverts")
     */
    public function adminAdverts(AdvertRepository $advertRepository): Response
    {
        $adverts = $advertRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'adverts' => $adverts,

        ]);
    }

    /**
     * @Route("/users", name="users")
     */
    public function adminUsers(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
