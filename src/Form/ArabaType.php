<?php

namespace App\Form;

use App\Entity\Araba;
use App\Entity\Category;
use phpDocumentor\Reflection\Type;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArabaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Category',EntityType::class,['class'=>Category::class
            ,'choice_label'=>'title',])
            ->add('title')
            ->add('Keywords')
            ->add('Description')
            ->add('Image',FileType::class,['label'=>'Car Image',
                'mapped'=>false,
                'required'=>false,
                
                ])
            ->add('Brand')
            ->add('Price')
            ->add('Model')
            ->add('Gear')
            ->add('Fue')
            ->add('Modealyear')
            ->add('status',ChoiceType::class,[
                'choices'=>[
                    'True'=>'True',
                    'False'=>'False'],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Araba::class,
        ]);
    }
}
