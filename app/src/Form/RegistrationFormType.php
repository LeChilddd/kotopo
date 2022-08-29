<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
//use Symfony\Component\Validator\Constraints\Length;
//use Symfony\Component\Validator\Constraints\NotBlank;
//use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
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
            // changer le type de card_number
            ->add('cardNumber', NumberType::class, [
                'label' => "Numéro de carte",
                'attr' => ['class' => 'form-control', 'placeholder' => "Numéro de carte"],
            ])

            ->add('gender', TextType::class, [
                'label' => "Genre",
                'attr' => ['class' => 'form-control', 'placeholder' => "Genre"],
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'attr' => ['class' => 'form-control', 'placeholder' => "Email"],
            ])

            ->add('rgpdConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'J\'accepte les règles RGPD ',
                'attr' => ['class' => 'required_field_toggle my-4 mx-2 form-check-input'],
                'row_attr' => ['class' => 'form-check form-switch ps-0 d-flex flex-row-reverse justify-content-end']
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => ['attr' => ['class' => 'form-control']],
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-cta form-control ms-auto mb-0 mt-2'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
