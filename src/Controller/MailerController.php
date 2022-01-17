<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
     /**
     * @Route("/contactseller", name="contactseller")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('noreply@annoncespaintball.com')
            ->to('sender@demo.com')
            ->subject('Une personne est très intéressée par votre annonce sur Annonces Paintball')
            ->html('<p>Une personne est très intéressée par votre annonce sur Annonces Paintball</p>');

        $mailer->send($email);
        return $this->redirectToRoute('home');
    }
}
