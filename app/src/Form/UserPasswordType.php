<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints as Assert;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', PasswordType::class,[
                'attr' => [ 'class' => 'form-control'],
                'label' => 'Ancien mot de passe',
                'label_attr' => [
                    'class' => 'mt-4'
                ],

                'constraints' =>[new Assert\NotBlank()]
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => ['attr' => ['class' => 'form-control']],
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'required' => true,
                'first_options'  => [
                    'label' => 'Nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'mt-4'
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'label_attr' => [
                        'class' => 'mt-4'
                    ],],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Modifier mon mot de passe'
            ])
        ;
    }
}
