<?php

namespace App\Controller;



use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(ContactRepository $repo)
    {
        $contacts = $repo->findAll();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts
        ]);
    }

    /**
     * Permet créer une annonce
     *
     * @Route("/contacts/new", name= "contacts_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le Contact a bien été enregistrée !"
            );
            
            return $this->redirectToRoute('contacts_show', [
                'slug' => $contact->getSlug() 
            ]);
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("/contacts/{slug}", name="contacts_show")
     * 
     * @return Response
     */
    public function show(Contact $contact)
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact
        ]);
    }

}
