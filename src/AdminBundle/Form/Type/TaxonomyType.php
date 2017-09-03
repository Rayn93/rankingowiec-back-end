<?php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TaxonomyType extends AbstractType
{

    public function getName()
    {
        return 'taxonomy';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Type\TextType::class, array(
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
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\AbstractTaxonomy'
        ));
    }
}
