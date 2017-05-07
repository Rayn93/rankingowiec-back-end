<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\Tag;


class TagsFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){

        $tag_list = array(
            'najlepszy',
            'aktorzy',
            'polskie',
            'politycy',
            'sukcesy',
            'zwierzeta',
            'tajemnice',
            'praca',
            'wojna',
            'broń'
        );

        foreach($tag_list as $name){

            $Tag = new Tag();
            $Tag->setName($name);

            $manager->persist($Tag);

            $this->addReference('tag_'.$name, $Tag);
        }



        $manager->flush();

    }

    public function getOrder(){
        return 0;
    }


}