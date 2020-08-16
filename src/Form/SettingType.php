<?php

namespace App\Form;

use App\Entity\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('company')
            ->add('adress')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('smtpserver')
            ->add('smtpemail')
            ->add('smtppassword')
            ->add('smtpport')
            ->add('facebook')
            ->add('instagram')
            ->add('twitter')
            ->add('aboutus')
            ->add('contact')
            ->add('reference')
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
            'data_class' => Setting::class,
        ]);
    }
}
