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

class PageType extends AbstractType
{

    public function getName()
    {
        return 'Page';
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {


        $builder
            ->add('title', Type\TextType::class, array(
                'label' => 'Tytuł',
                'attr' => array(
                    'placeholder' => 'Tytuł strony',
                ),
            ))
            ->add('slug', Type\TextType::class, array(
                'label' => 'Alias',
                'attr' => array(
                    'placeholder' => 'Alias',
                )
            ))

            ->add('content', CKEditorType::class, array(
                'label' => 'Zawartość strony',
                'attr' => array(
                    'rows' => 10,
                    'placeholder' => 'Zawartość strony',
                )
            ))
            ->add('thumbnailFile', Type\FileType::class, array(
                'label' => 'Tło górne',
                'data_class' => null,
            ))
            ->add('publishedDate', Type\DateTimeType::class, array(
                'label' => 'Data publikacji',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ))

            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();
    }


    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\Page',
        ));
    }

}
