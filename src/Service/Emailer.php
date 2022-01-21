<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Emailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $recipient, string $message, string $contactmail): void
    {
        $email = (new Email())
            ->from('noreply@annoncespaintball.com')
            ->to($recipient)
            ->subject('Une personne est intéressée par votre annonce sur Annonces Paintball')
            ->html('<p>' . $message . $contactmail . '</p>');

        $this->mailer->send($email);
    }
}
