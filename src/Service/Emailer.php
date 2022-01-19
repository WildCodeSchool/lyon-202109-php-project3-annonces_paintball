<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Emailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->MailerInterface = $mailer;
    }
    
    public function sendMail(): void
    {
        $email = (new Email())
            ->from('noreply@annoncespaintball.com')
            ->to('sender@demo.com')
            ->subject('Une personne est intéressée par votre annonce sur Annonces Paintball')
            ->html('<p>Une personne est intéressée par votre annonce sur Annonces Paintball</p>');

        $this->mailer->send($email);
    }
}
