<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
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
