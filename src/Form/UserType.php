<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Email'
                ]
            ])
            ->add('fullname', TextType::class,[
                'label' => 'Fullname',
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Fullname'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Roles' => null,
                    'Developer' => 'ROLE_DEVELOPER',
                    'QA' => 'ROLE_QA',
                    'Project manager' => 'ROLE_PM',
                ],
                'attr' => [
                    'class' => 'form-select'
                ]
            ])

            ->add('password', PasswordType::class,[
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Password'
                ]
            ])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
