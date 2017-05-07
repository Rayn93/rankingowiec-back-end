<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\Category;


class CategoriesFixtures extends AbstractFixture{


    public function load(ObjectManager $manager){


        $category_list = array(
            'people' => 'Ludzie',
            'films' => 'Filmy',
            'tv' => 'TV',
            'sport' => 'Sport',
            'funny' => 'Zabawne',
            'food' => 'Jedzenie & Napoje'
        );

        foreach($category_list as $key => $name){

            $category = new Category();
            $category->setName($name)
                ->setSlug($name);

            $manager->persist($category);
        }

        $manager->flush();

    }


}