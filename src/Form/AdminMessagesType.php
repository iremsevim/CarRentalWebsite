<?php

namespace App\Form;

use App\Entity\AdminMessages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminMessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('subject')
            ->add('message')
            ->add('status')
            ->add('ip')
            ->add('note')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdminMessages::class,
        ]);
    }
}
