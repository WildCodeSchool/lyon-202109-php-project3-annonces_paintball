<?php

namespace App\Controller;

use App\Entity\Advert;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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

    /**
     * @Route("/contactseller", name="contactseller")
     */
    public function sendEmail(MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from('noreply@annoncespaintball.com')
            ->to('sender@demo.com')
            ->subject('Une personne est intéressée par votre annonce sur Annonces Paintball')
            ->html('<p>Une personne est intéressée par votre annonce sur Annonces Paintball</p>');

        $mailer->send($email);
    }
}
