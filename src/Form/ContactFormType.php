<?php

namespace App\Form;

use App\Entity\ContactClient;
use Symfony\Component\Form\AbstractType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('description', TextareaType::class, [
            'attr' => [
                'class' =>'form-control mb-3'
            ]
        ])
        ->add('captcha', CaptchaType::class, [
            'attr' => [
                'class' =>'form-control w-50 mb-3'
            ],
            'invalid_message'=> 'réessayez ! ça ne correspond pas',
        ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactClient::class,
        ]);
    }
}
