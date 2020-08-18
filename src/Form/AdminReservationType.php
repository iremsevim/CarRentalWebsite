<?php

namespace App\Form;

use App\Entity\AdminReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid')
            ->add('arabaid')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('phone')
            ->add('checkin')
            ->add('checkout')
            ->add('days')
            ->add('total')
            ->add('ip')
            ->add('note')
            ->add('message')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdminReservation::class,
        ]);
    }
}
