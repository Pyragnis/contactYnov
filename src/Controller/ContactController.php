<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{

    #[Route('/add', name: 'app_add')]
    public function AddContact(Environment $twig, FormFactoryInterface $factory, EntityManagerInterface $em, Request $request, SluggerInterface $slugger): Response
    {       // get the login error if there is one
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();


            return $this->redirectToRoute('app_list');
        }




        return $this->render('addContact.html.twig', [
            'Contact' => $form->createView(),
            'row' => $contact
        ]);
    }
    #[Route('/list', name: 'app_list')]
    public function list(Environment $twig, FormFactoryInterface $factory, EntityManagerInterface $em, Request $request, SluggerInterface $slugger, ContactRepository $contact): Response
    {       // get the login error if there is one
        $Contacts = $contact->findAll();

        $html = $twig->render('listeContact.html.twig', ['contacts' => $Contacts]);

        return new Response($html);
    }
}
