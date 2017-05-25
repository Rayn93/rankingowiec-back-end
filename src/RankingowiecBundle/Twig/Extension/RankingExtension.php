<?php


namespace RankingowiecBundle\Twig\Extension;

//Rozszerzenia dla szablonów Twig
class RankingExtension extends \Twig_Extension {


    public function getName(){
        return 'rankingowiec_extension';
    }

    //Rejestracja rozszerzeń
    public function getFunctions(){
        return array(
            new \Twig_SimpleFunction('rankingowiec_test', array($this, 'test'))
        );
    }


    public function test(){
        return 'test -ok';
    }



}