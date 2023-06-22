<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'row_attr' => ['class' => 'form-floating mb-1'],
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom :',
                'row_attr' => ['class' => 'form-floating mb-1'],
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('email', TextType::class, [
                'label' => 'Email :',
                'row_attr' => ['class' => 'form-floating mb-1'],
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('tel', TelType::class, [
                'label' => 'numéro de téléphone :'
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Message',
                'row_attr' => ['class' => 'form-floating mb-1'],
                'attr' => ['placeholder' => 'Message', 'resize' => 'none',]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
