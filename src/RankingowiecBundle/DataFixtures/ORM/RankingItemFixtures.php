<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\RankingItem;


class RankingItemFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){


//        $item_list = array(
//
//            array(
//                'ranking' => 'Kto ma największy wpływ na rządy w 2017 roku polską?',
//                'item' => 'Jestem mordercą [2016]',
//                'plus' => 300,
//                'minus' => 123
//            ),
//
//            array(
//                'ranking' => 'Teorie spiskowe w które wierzę.',
//                'item' => 'Sami Swoi [1986]',
//                'plus' => 1300,
//                'minus' => 2123
//            ),
//
//        );
//
//        foreach($item_list as $details){
//
//            $RankingItem = new RankingItem();
//
//            $RankingItem->setPlus($details['plus'])
//                ->setMinus($details['minus']);
////                ->setRanking($details['ranking'])
////                ->setItem($details['item']);
//
//
//            $this->addReference('ranking_'.$details['ranking'], $RankingItem);
//            $this->addReference('item_'.$details['item'], $RankingItem);
//
//
////            foreach( $details['tags'] as $tag_name){
////                $Ranking->addTag($this->getReference('tag_'.$tag_name));
////            }
//
//            $manager->persist($RankingItem);
//        }
//
//        $manager->flush();

    }

    public function getOrder(){
        return 3;
    }


}