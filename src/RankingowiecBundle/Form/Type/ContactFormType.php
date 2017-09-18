<?php


namespace RankingowiecBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Validator\Constraints as Assert;


class ContactFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){


        $builder
            ->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Imie i nazwisko',
                ),
                'constraints' => array(
                    new Assert\NotBlank()
                ),
                'translation_domain' => 'messages'
            ))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'Twój adres E-mail'
                ),
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Email()
                )
            ))
            ->add('message', TextareaType::class, array(
                'attr' => array(
                    'rows' => 10,
                    'placeholder' => 'Wiadomość'
                ),
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'attr' => array(
                    'options' => array(
                        'theme' => 'light',
                        'type' => 'image',
                        'size' => 'normal',
                        'defer' => true,
                        'async' => true,
                    )
                )
            ,
                'mapped' => false,
                'constraints' => array(
                    new RecaptchaTrue()
                )
            ))
            ->add('send', SubmitType::class, array('label' => 'WYŚLIJ'))
            ->getForm();


    }

    public function getName()
    {
        return 'contact';
    }






}