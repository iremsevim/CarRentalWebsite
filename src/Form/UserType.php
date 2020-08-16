<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('roles',ChoiceType::class,[
                'choices'=>[
                    'Admin'=>'ROLE_ADMIN',
                    'User'=>'ROLE_USER'
                ],

            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('name')
            ->add('surname')
            ->add('Image',FileType::class,['label'=>'User Image',
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('status',ChoiceType::class,[
                'choices'=>[
                    'True'=>'True',
                    'False'=>'False'],

            ])
        ;
        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            function ($rolesArray){
                return count($rolesArray)?$rolesArray[0]:null;
            },
            function ($rolesString)
            {
                return[$rolesString];
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
