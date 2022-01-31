<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\PaintballAdvertAuthenticator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        GuardAuthenticatorHandler $guardHandler,
        PaintballAdvertAuthenticator $authenticator,
        EntityManagerInterface $entityManager
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()/**@phpstan-ignore-line */
                )
            );

            $user->setIsActive(true);
            //TODO - Change that with a real photo import
            $user->setPhoto((new Photo())->setUrl('https://i.pravatar.cc/200?img=' . rand(1, 100)));
            $user->setRegistrationDate(new DateTime());
            $user->setLastConnectionDate(new DateTime());

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(/**@phpstan-ignore-line */
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
