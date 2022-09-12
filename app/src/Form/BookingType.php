<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beginDate', DateTimeType::class, [
                'label' => 'Date de début',
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy - H:i',
                'attr' => [
                    'class' => 'flatpickr_hour form-control mb-3',
                    'autocomplete' => 'off',
                    'placeholder' => "jj/mm/aaaa - hh:mn"
                ]
            ])
            ->add('endDate', DateTimeType::class, [
                'label' => 'Date de fin',
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy - H:i',
                'attr' => [
                    'class' => 'flatpickr_hour form-control mb-3',
                    'autocomplete' => 'off',
                    'placeholder' => "jj/mm/aaaa - hh:mn"
                ]
            ])
            ->add('recurrenceType', ChoiceType::class, [
                'label' => 'Type de récurrence',
                'required' => true,
                "choices" => $this->getChoiceRecurrenceType(),
                'attr' => ['class' => 'form-control']
            ])
            ->add('recurrenceDate',DateTimeType::class, [
                'label' => 'fin la récurrence',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'class' => 'flatpickr form-control mb-3',
                    'autocomplete' => 'off',
                    'placeholder' => "jj/mm/aaaa"
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
    public function getChoiceRecurrenceType(): array
    {
        $choices = Booking::FUNDING_TYPE_LABEL;
        $output = [];
        foreach ($choices as $key => $value) {
            $output[$value] = $key;
        }
        return $output;
    }
}
