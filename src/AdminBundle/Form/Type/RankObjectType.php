<?php

namespace AdminBundle\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class RankObjectType extends AbstractType
{

    public function getName()
    {
        return 'RankObject';
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {


        $builder
            ->add('title', Type\TextType::class, array(
                'label' => 'Nazwa',
                'attr' => array(
                    'placeholder' => 'Nazwa',
                ),
            ))
            ->add('slug', Type\TextType::class, array(
                'label' => 'Alias',
                'attr' => array(
                    'placeholder' => 'Alias',
                )
            ))
            ->add('more_link', Type\TextType::class, array(
                'label' => 'Link',
                'attr' => array(
                    'placeholder' => 'Link np. do Wikipedii',
                )
            ))
            ->add('description', Type\TextareaType::class, array(
                'label' => 'Opis',
                'attr' => array(
                    'rows' => 10,
                    'placeholder' => 'Opis obiektu',
                )
            ))
            ->add('thumbnailFile', Type\FileType::class, array(
                'label' => 'Miniaturka',
                'data_class' => null,
            ))
            ->add('publishedDate', Type\DateTimeType::class, array(
                'label' => 'Data publikacji',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ))
//            ->add('homePage', Type\CheckboxType::class, array(
//                'label' => 'Strona główna?',
//                'required' => false
//            ))
            ->add('category', EntityType::class, array(
                'label' => 'Kategoria',
                'class' => 'RankingowiecBundle\Entity\Category',
                'choice_label' => 'name',
                'empty_data' => 'Wybierz kategorię'
            ))
//            ->add('tags', EntityType::class, array(
//                'label' => 'Tagi',
//                'class' => 'RankingowiecBundle\Entity\Tag',
//                'choice_label' => 'name',
//                'multiple' => true,
//                'attr' => array(
//                    'placeholder' => 'Dodaj tagi'
//                )
//            ))
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();
    }


    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\RankObject',
        ));
    }

}
