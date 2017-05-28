<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\Page;


class PagesFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){


        $page_list = array(

            array(
                'title' => 'Regulamin',
                'slug' => 'Regulamin',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Kontakt',
                'slug' => 'Kontakt',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => NULL,
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'FAQ',
                'slug' => 'FAQ',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Jak to działa',
                'slug' => 'Jak to działa',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/items-photo/forest.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Mapa strony',
                'slug' => 'mapa-strony',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/static_backgroud.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),


        );

        foreach($page_list as $details){

            $Page = new Page();

            $Page->setTitle($details['title'])
                ->setContent($details['content'])
                ->setThumbnail($details['thumbnail'])
                ->setAuthor($details['author'])
                ->setCreateDate(new \DateTime($details['create_date']));

            if($details['published_date'] != NULL){
                $Page->setPublishedDate(new \DateTime($details['published_date']));
            }

            $manager->persist($Page);
        }

        $manager->flush();
    }

    public function getOrder(){
        return 2;
    }


}