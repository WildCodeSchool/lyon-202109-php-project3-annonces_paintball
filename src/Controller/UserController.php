<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(): Response
    {
        $user = $this->getUser();
        if ($user) {
            return $this->render('user/index.html.twig', [
                'user' => $user,
            ]);
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/profile/edit", name="profile_edit")
     */
    public function profileEdit(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/adverts", name="adverts")
     */
    public function showUserAdverts(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/advert/{id}/edit", name="advertEdit", requirements={"id"="\d+"})
     */
    public function editUserAdvert(Advert $advert): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
