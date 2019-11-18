<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;

use App\Form\ArticleType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('Categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'titre'
         ])
            ->add('content')
            ->add('image')
        //    ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,

        ]);
    }
}
