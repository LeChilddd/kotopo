<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'attr' => ['class' => 'form-control', 'placeholder' => "Prénom"],
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom de famille",
                'attr' => ['class' => 'form-control', 'placeholder' => "Nom de famille"],
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'attr' => ['class' => 'form-control', 'placeholder' => "Email"],
            ])
            ->add('subject', TextType::class, [
                'label' => "Sujet",
                'attr' => ['class' => 'form-control', 'placeholder' => "Sujet"],
            ])
            ->add('message', TextareaType::class, [
                'label' => "Message",
                'attr' => ['class' => 'form-control', 'rows' => '10', 'placeholder' => "Message"],
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-cta form-control ms-auto mb-0 mt-2'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
