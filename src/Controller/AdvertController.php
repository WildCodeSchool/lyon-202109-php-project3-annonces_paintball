<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdvertType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_USER")
     */
    public function new(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $advert = new Advert();
        $advert->setCreationDate(new \DateTime('now'));
        $form = $this->createForm(AdvertType::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $advert->setOwner($user);/**@phpstan-ignore-line */

            $entityManager->persist($advert);
            $entityManager->flush();

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
