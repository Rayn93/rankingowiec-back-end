<?php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CategoryDeleteType extends AbstractType {
    
    private $category;

    function __construct($category) {
        $this->category = $category;
    }

    public function getName() {
        return 'deleteCategory';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $Category = $this->category;
        
        $builder
//            ->add('setNull', Type\CheckboxType::class, array(
//                'label' => 'Ustaw wszystkie rankingi i obiekty bez kategorii'
//            ))
            ->add('newCategory', EntityType::class, array(
                'label' => 'Wybierz nową kategorię dla obiektów',
                'empty_value' => 'Wybierz kategorię',
                'class' => 'RankingowiecBundle\Entity\Category',
                'property' => 'name',
                'query_builder' => function(EntityRepository $er) use ($Category){
                    return $er->createQueryBuilder('c')
                                    ->where('c.id != :categoryId')
                                    ->setParameter('categoryId', $Category->getId());
                }
            ))
            ->add('submit', SubmitType::class, array('label' => 'Wykonaj'))
            ->getForm();
    }
}
