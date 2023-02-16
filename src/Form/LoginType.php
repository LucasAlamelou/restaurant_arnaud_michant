<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => "Adresse email",
                "required" => true,
                'attr' => ['autofocus' => true],
                "constraints" => [
                    new NotBlank(["message" => "Une adresse email doit être renseigné !"]),
                    new Email(['message' => 'L\'email "{{ value }}" n\'est pas un email valide.'])
                ]
            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Un mot de passe doit être renseigné !"]),
                    new Length([
                        'min' => 5,
                        'max' => 30,
                        'minMessage' => 'Votre mot de passe doit faire minimum {{ limit }}',
                        'maxMessage' => 'Votre mot de passe doit faire maximum {{ limit }}',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => true
        ]);
    }
}
