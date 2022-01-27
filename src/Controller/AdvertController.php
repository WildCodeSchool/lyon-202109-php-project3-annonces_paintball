<?php

namespace App\Controller;

use App\Entity\Advert;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdvertType;
use App\Repository\AdvertRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;
use DateTimeInterface;

/**
 * @Route("/advert", name="advert_")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(AdvertRepository $advertRepository): Response
    {
        return $this->render('advert/list.html.twig', [
            'adverts' => $advertRepository->findAll(),
        ]);
    }


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

        $advert->setStatus('En cours');
        $advert->setCreationDate(new DateTime());
        $advert->setUpdateDate(new DateTime());
        $expirationDate = date_add(
            new DateTime(),
            date_interval_create_from_date_string('30 days')/**@phpstan-ignore-line */
        );
        if ($expirationDate != false) {
            $advert->setEndDate($expirationDate);
        }
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
        return $this->render('advert/show.html.twig', [
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
