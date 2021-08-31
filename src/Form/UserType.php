<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class) //EmailType::class type of input
//            ->add('roles') comment or delete fields that don't be manipulating by user
            ->add('password', PasswordType::class) //PasswordType::class type of input
//            ->add('baneado') comment or delete fields that don't be manipulating by user
            ->add('nombre') //without type sets input to text
            ->add('Registrar', SubmitType::class) //SubmitType::class submit button
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
