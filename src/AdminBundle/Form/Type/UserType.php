<?php

namespace AdminBundle\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function getName()
    {
        return 'User';
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {


        $builder
            ->add('username', Type\TextType::class, array(
                'label' => 'Nick',
                'attr' => array(
                    'placeholder' => 'Nazwa użytkownika',
                ),
            ))
            ->add('email', Type\TextType::class, array(
                'label' => 'Email',
                'attr' => array(
                    'placeholder' => 'Adres email użytkownika',
                )
            ))
            ->add('expired', Type\CheckboxType::class, array(
                'label' => 'Konto wygasło'
            ))
            ->add('locked', Type\CheckboxType::class, array(
                'label' => 'Konto zablokowane'
            ))
            ->add('credentialsExpired', Type\CheckboxType::class, array(
                'label' => 'Dane uwierzytelniające wygasły'
            ))
            ->add('enabled', Type\CheckboxType::class, array(
                'label' => 'Konto aktywowane'
            ))
            ->add('roles', ChoiceType::class, array(
                'choices'  => array(
                    'Użytkownik' => 'ROLE_USER',
                    'Redaktor' => 'ROLE_EDITOR',
                    'Administrator' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ),
                'choices_as_values' => true,
                'multiple' => true,
            ))
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'RankingowiecBundle\Entity\User',
        ));
    }


}
