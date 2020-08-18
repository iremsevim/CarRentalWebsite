<?php

namespace App\Form;

use App\Entity\AdminComment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('comment')
            ->add('status')
            ->add('ip')
            ->add('userid')
            ->add('created_at')
            ->add('updated_at')
            ->add('rate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdminComment::class,
        ]);
    }
}
