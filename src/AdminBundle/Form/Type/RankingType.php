<?php

namespace AdminBundle\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class RankingType extends AbstractType
{

    public function getName()
    {
        return 'Ranking';
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {


        $builder
            ->add('title', Type\TextType::class, array(
                'label' => 'Tytuł',
                'attr' => array(
                    'placeholder' => 'Tytuł rankingu',
                ),
            ))
            ->add('slug', Type\TextType::class, array(
                'label' => 'Alias',
                'attr' => array(
                    'placeholder' => 'Alias',
                )
            ))

            ->add('description', CKEditorType::class, array(
                'label' => 'Opis',
                'attr' => array(
                    'rows' => 10,
                    'placeholder' => 'Opis rankingu',
                )
            ))

//            ->add('items', AutocompleteType::class, array(
//                'label' => 'Obiekty',
//                'attr' => array(
//                    'placeholder' => 'Link np. do Wikipedii',
//                ),
//                'class' => 'RankingowiecBundle\Entity\RankObject'
//            ))

            ->add('thumbnailFile', Type\FileType::class, array(
                'label' => 'Miniaturka',
                'data_class' => null,
            ))

            ->add('publishedDate', Type\DateTimeType::class, array(
                'label' => 'Data publikacji',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ))
            ->add('home_page', Type\CheckboxType::class, array(
                'label' => 'Strona główna',
                'required' => false
            ))
            ->add('main_slider', Type\CheckboxType::class, array(
                'label' => 'Slider',
                'required' => false
            ))
            ->add('categories', EntityType::class, array(
                'label' => 'Kategoria',
                'class' => 'RankingowiecBundle\Entity\Category',
                'choice_label' => 'name',
                'multiple' => true,
                'empty_data' => 'Wybierz kategorię'
            ))
            ->add('tags', EntityType::class, array(
                'label' => 'Tagi',
                'class' => 'RankingowiecBundle\Entity\Tag',
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => array(
                    'placeholder' => 'Dodaj tagi'
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();
    }


    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\Ranking',
        ));
    }

}
