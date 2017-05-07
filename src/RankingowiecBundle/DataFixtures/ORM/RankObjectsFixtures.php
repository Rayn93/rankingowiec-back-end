<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\RankObject;


class RankObjectsFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){


        $object_list = array(

            array(
                'title' => 'Jestem mordercą [2016]',
                'slug' => 'Jestem mordercą [2016]',
                'description' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'more_link' => 'https://pl.wikipedia.org/wiki/Jestem_morderc%C4%85',
                'category' => 'films',
                'total_result' => array(
                    'plus' => 2091,
                    'minus' => 126
                ),
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Sami Swoi [1986]',
                'slug' => 'Sami Swoi [1986',
                'description' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'more_link' => 'https://pl.wikipedia.org/wiki/Jestem_morderc%C4%85',
                'category' => 'films',
                'total_result' => array(
                    'plus' => 2091,
                    'minus' => 126
                ),
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Bogowie',
                'slug' => 'Bogowie [2015]',
                'description' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'more_link' => 'https://pl.wikipedia.org/wiki/Jestem_morderc%C4%85',
                'category' => 'films',
                'total_result' => array(
                    'plus' => 2091,
                    'minus' => 126
                ),
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Pianista',
                'slug' => 'Pianista [2000]',
                'description' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'more_link' => 'https://pl.wikipedia.org/wiki/Jestem_morderc%C4%85',
                'category' => 'films',
                'total_result' => array(
                    'plus' => 2091,
                    'minus' => 126
                ),
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            )
        );

        foreach($object_list as $details){

            $RankObject = new RankObject();

            $RankObject->setTitle($details['title'])
                ->setSlug($details['slug'])
                ->setDescription($details['description'])
                ->setThumbnail($details['thumbnail'])
                ->setAuthor($details['author'])
                ->setCreateDate(new \DateTime($details['create_date']))
                ->setTotalResult($details['total_result'])
                ->setMoreLink($details['more_link']);

            if($details['published_date'] != NULL){
                $RankObject->setPublishedDate(new \DateTime($details['published_date']));
            }

            $RankObject->setCategory($this->getReference('category_'.$details['category']));

            $manager->persist($RankObject);
        }

        $manager->flush();

    }

    public function getOrder(){
        return 1;
    }


}