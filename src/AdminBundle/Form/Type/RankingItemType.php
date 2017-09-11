<?php

namespace AdminBundle\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;


class RankingItemType extends AbstractType
{

    public function getName()
    {
        return 'RankingItem';
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {


        $builder
            ->add('item', EntityType::class, [
                'class' => 'RankingowiecBundle\Entity\RankObject',
                'choice_label' => 'title',
//                'query_builder' => function(UserRepository $repo) {
//                    return $repo->createIsScientistQueryBuilder();
//                }
            ])
            ->getForm();
    }


    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\RankingItem',
        ));
    }

}
