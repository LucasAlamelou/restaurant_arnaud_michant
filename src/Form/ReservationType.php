<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotEqualTo;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'row_attr' => ['class' => 'form-date', 'id' => 'form-date-id'],
                'label' => 'Date',
                'required' => true,
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                "constraints" => [
                    new NotBlank(["message" => "Une date doit être renseigné !"]),
                ]
            ])
            ->add('hour', HiddenType::class, [
                'row_attr' => ['class' => 'form-hour', 'id' => 'form-hour-id'],
                'label' => 'Heure',
                'required' => true,
                "constraints" => [
                    new NotBlank(["message" => "Une heure doit être renseigné !"])
                ]
            ])
            ->add('nameOfClient', TextType::class, [
                'row_attr' => ['class' => 'form-name-client', 'id' => 'form-name-client-id'],
                'label' => 'Nom de réservation',
                'required' => true,
                "constraints" => [
                    new NotBlank(["message" => "Une nom doit être renseigné !"])
                ]
            ])
            ->add('nbCouvert', NumberType::class, [
                'row_attr' => ['class' => 'form-nb-couvert', 'id' => 'form-nb-couvert-id'],
                'label' => 'Nombre de couvert',
                'required' => true,
                "constraints" => [
                    new NotBlank(["message" => "Le nombre de couvert doit être renseigné !"]),
                    new NotEqualTo(0, null, "Minimum pour 1 personne !"),
                    new Length(
                        min: 1,
                        max: 6,
                        minMessage: 'Vous devez réserver pour au moins une personne !',
                        maxMessage: 'Le nombre de couvert maximum par table est 6 ! '
                    )
                ]
            ])
            ->add('allergns', TextType::class, [
                'row_attr' => ['class' => 'form-allergns', 'id' => 'form-allergns-id'],
                'label' => 'Vos allergies',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'csrf_protection' => true
        ]);
    }
}
