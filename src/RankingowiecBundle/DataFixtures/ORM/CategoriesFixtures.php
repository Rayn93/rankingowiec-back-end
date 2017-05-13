<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\Category;


class CategoriesFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){


        $category_list = array(
            'people' => 'Ludzie',
            'films' => 'Filmy',
            'tv' => 'TV',
            'sport' => 'Sport',
            'funny' => 'Zabawne',
            'food' => 'Jedzenie & Napoje',
            'popular' => 'Popularne'
        );

        foreach($category_list as $key => $name){

            $Category = new Category();
            $Category->setName($name);

            $manager->persist($Category);
            
            $this->addReference('category_'.$key, $Category);
        }

        $manager->flush();

    }

    public function getOrder(){
        return 0;
    }


}