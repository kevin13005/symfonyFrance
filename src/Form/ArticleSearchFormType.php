<?php

namespace App\Form;

use App\Entity\ArticleSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArticleSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('minPrice', IntegerType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix min',
                'class' =>'form-control',
            ]
        ])
        ->add('maxPrice', IntegerType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix max',
                'class' =>'form-control',
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleSearch::class,
            'method'=>'get',
            'csrf_protection'=>false,
        ]);
        dump($resolver);
    }

    //pour retourner une url propre
    public function getBlockPrefix()
    {
        return '';
    }
}
