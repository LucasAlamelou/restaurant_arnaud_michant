<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Un nom de famille doit être renseigné !"]),
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Un prénom doit être renseigné !"]),
                ]
            ])
            ->add('allergns', TextType::class, [
                'label' => 'Liste de vos allergnes',
                'required' => false,
            ])
            ->add('nbCouvertDefault', NumberType::class, [
                "label" => "Nombre de couvert par défaut",
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserClient::class,
            'csrf_protection' => true
        ]);
    }
}
