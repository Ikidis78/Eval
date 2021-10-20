<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends AbstractType
{
    /**
     * Perme d'avoir la configuration de base d'un champ 
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder)
    {
        return[
             'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder]
                ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Tapez un super tittre pour votre annonce"))
            ->add('slug', TextType::class, $this->getConfiguration("Chaine URL", "Adresse web (Automatique)"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("URL de l'image principale", "Insérez une image de votre logement"))
            ->add('introduction', TextType::class, $this->getConfiguration("Description", "Indiquez une description globale de votre annonce"))
            ->add('content', TextareaType::class, $this->getConfiguration("Description détaillé", "Donnez envie à la clientèle !"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Révéler le nombre de chambre(s) disponible(s)"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", "Indiquez le montant par nuit"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
