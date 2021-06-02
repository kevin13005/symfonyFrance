<?php

namespace App\Controller;

use App\Entity\ContactClient;
use App\Form\ContactFormType;
use App\Message\MailNotification;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {

        $contactClient = new ContactClient();
        $contactClient->setUser($this->getUser())
                        ->setCreatedAt(new DateTime('now'));
        
        $form = $this->createForm(ContactFormType::class, $contactClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactClient = $form->getData();

            $em->persist($contactClient);
            $em->flush();

            //on utilise le dispatcheur du composant messenger pour envoyer notre mail
            //on a cree une classe enveloppe (MailNotification) et une classe qui gere les donnees et les methodes voulues
            //pour envoyer notre mail(mailNotificationHandler)
           $this->dispatchMessage(new MailNotification($contactClient->getDescription(), $contactClient->getId(), $contactClient->getUser()->getEmail()));

           $this->addFlash(
            'notice',
            'Ton mail a bien été envoyé!'
            );

            return $this->redirectToRoute("contact");
        }
        if($form->isSubmitted() && !$form->isValid()){
            $this->addFlash(
                'error',
                'Il y a un probleme, l envoi n est pas effectue !'
                );
        }

        return $this->render('contact/contact.html.twig', [
            'contactform' => $form->createView(),
            'controller_name' => 'ContactController',
        ]);
    }
}
