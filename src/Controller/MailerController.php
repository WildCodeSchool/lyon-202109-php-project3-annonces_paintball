<?php

namespace App\Controller;

use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Emailer;

class MailerController extends AbstractController
{
    /**
     * @Route("/contactseller", name="contactseller")
     */
    public function contactSeller(Emailer $emailer): Response
    {
        $recipient = 'auteurannonce@monmail.com';
        $message = 'Bonjour,<br>
        un utilisateur est intéressé par votre annonce, pour échanger avec lui,
         vous pouvez lui addresser un message directement sur sa messagerie personnelle:<br><br>';
        $contactmail = 'acheteurpotentiel@monmail.com';
        $emailer->sendMail($recipient, $message, $contactmail);
        return $this->redirectToRoute('home');
    }
}
