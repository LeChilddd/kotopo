<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beginAt', DateTimeType::class, [
                'label' => 'Date de début',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy - H:i',
                'attr' => [
                    'class' => 'flatpickr_hour form-control mb-3',
                    'autocomplete' => 'off',
                    'placeholder' => "jj/mm/aaaa - hh:mn"
                ]
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'Date de fin',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy - H:i',
                'attr' => [
                    'class' => 'flatpickr_hour form-control mb-3',
                    'autocomplete' => 'off',
                    'placeholder' => "jj/mm/aaaa - hh:mn"
                ]
            ])
            ->add('title', TextType::class, [
                'label' => "Intitulé de l'événement",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Intitulé"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
