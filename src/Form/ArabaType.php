<?php

namespace App\Form;

use App\Entity\Araba;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArabaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('Category')
            ->add('Keywords')
            ->add('Description')
            ->add('Image')
            ->add('Brand')
            ->add('Price')
            ->add('Model')
            ->add('Gear')
            ->add('Fue')
            ->add('Modealyear')
            ->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Araba::class,
        ]);
    }
}
