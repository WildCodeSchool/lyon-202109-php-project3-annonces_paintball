<?php

namespace App\Controller;

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
        $emailer->sendMail();
        return $this->redirectToRoute('home');
    }
}
