<?php

namespace App\Controller;

use App\Form\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Upload;
use App\Entity\Photo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $upload->getName();
            $fileName = md5(uniqid()) . ' . ' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $upload->setName($fileName);
            $upload->setPhoto((new Photo()));

            $entityManagerInterface->persist($upload);
            $entityManagerInterface->flush();
        }

        return $this->render('upload/index.html.twig', array(
            'form' => $form->createView(),
            ));
    }
}
