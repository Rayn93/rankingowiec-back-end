<?php

namespace RankingowiecBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RankingowiecBundle\Entity\Ranking;


class RankingsFixtures extends AbstractFixture implements OrderedFixtureInterface{


    public function load(ObjectManager $manager){


        $ranking_list = array(

            array(
                'title' => 'Kto ma największy wpływ na rządy w 2017 roku polską?',
                'slug' => 'Kto ma największy wpływ na rządy w 2017 roku polską?',
                'description' => 'W tym rankingu głosujemy na najlepszy polski film wszechczasów. Sprawa nie jest łatwa ponieważ polskie kindo od dziesiątek lat wypuszcza świetne produkcje. Jesteśmy niezmiernie ciekawi który film wygra w tym rankingu.',
                'items' => array('Jestem Mordercą', 'Bogowie', 'Pianista', 'Przesłuchanie', 'Wołyń', 'Amator', 'Twardowski 2.0', 'Pora umierać', 'Sami swoi'),
                'items_result' => array(
                    'id1' => array('plus' => 2021, 'minus' => 341),
                    'id302' => array('plus' => 102, 'minus' => 2301),
                    'id1234' => array('plus' => 302, 'minus' => 4201),
                    'id9821' => array('plus' => 202, 'minus' => 1101),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide1.jpg',
                'categories' => array('people', 'films'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 20312
            ),

            array(
                'title' => 'Teorie spiskowe w które wierzę.',
                'slug' => 'Teorie spiskowe w które wierzę.',
                'description' => 'W tym rankingu głosujemy na najlepszy polski film wszechczasów. Sprawa nie jest łatwa ponieważ polskie kindo od dziesiątek lat wypuszcza świetne produkcje. Jesteśmy niezmiernie ciekawi który film wygra w tym rankingu.',
                'items' => array('Jestem Mordercą', 'Bogowie', 'Pianista', 'Przesłuchanie', 'Wołyń', 'Amator', 'Twardowski 2.0', 'Pora umierać', 'Sami swoi'),
                'items_result' => array(
                    'id1' => array('plus' => 2021, 'minus' => 341),
                    'id302' => array('plus' => 102, 'minus' => 2301),
                    'id1234' => array('plus' => 302, 'minus' => 4201),
                    'id9821' => array('plus' => 202, 'minus' => 1101),
                    'id12345' => array('plus' => 2021, 'minus' => 341),
                    'id30232' => array('plus' => 102, 'minus' => 2301),
                    'id123462' => array('plus' => 302, 'minus' => 4201),
                    'id98211' => array('plus' => 202, 'minus' => 1101),
                    'id30239' => array('plus' => 102, 'minus' => 2301),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide1.jpg',
                'categories' => array('people', 'films'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-01 12:12:12',
                'published_date' => '2017-05-01 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 203121
            ),

            array(
                'title' => 'Najlepszy polski film wszechczasów',
                'slug' => 'Najlepszy polski film wszechczasów',
                'description' => 'W tym rankingu głosujemy na najlepszy polski film wszechczasów. Sprawa nie jest łatwa ponieważ polskie kindo od dziesiątek lat wypuszcza świetne produkcje. Jesteśmy niezmiernie ciekawi który film wygra w tym rankingu.',
                'items' => array('Jestem Mordercą', 'Bogowie', 'Pianista', 'Przesłuchanie', 'Wołyń', 'Amator', 'Twardowski 2.0', 'Pora umierać', 'Sami swoi'),
                'items_result' => array(
                    'id1' => array('plus' => 2021, 'minus' => 341),
                    'id302' => array('plus' => 102, 'minus' => 2301),
                    'id1234' => array('plus' => 302, 'minus' => 4201),
                    'id9821' => array('plus' => 202, 'minus' => 1101),
                    'id12345' => array('plus' => 2021, 'minus' => 341),
                    'id30232' => array('plus' => 102, 'minus' => 2301),
                    'id123462' => array('plus' => 302, 'minus' => 4201),
                    'id98211' => array('plus' => 202, 'minus' => 1101),
                    'id30239' => array('plus' => 102, 'minus' => 2301),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide1.jpg',
                'categories' => array('people', 'films'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-04-01 12:12:12',
                'published_date' => '2017-04-01 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 203124
            ),

            array(
                'title' => 'Kto najbardziej przyczynił się do rozwoju polski',
                'slug' => 'Kto najbardziej przyczynił się do rozwoju polski',
                'description' => 'W tym rankingu głosujemy na najlepszy polski film wszechczasów. Sprawa nie jest łatwa ponieważ polskie kindo od dziesiątek lat wypuszcza świetne produkcje. Jesteśmy niezmiernie ciekawi który film wygra w tym rankingu.',
                'items' => array('Jestem Mordercą', 'Bogowie', 'Pianista', 'Przesłuchanie', 'Wołyń', 'Amator', 'Twardowski 2.0', 'Pora umierać', 'Sami swoi'),
                'items_result' => array(
                    'id1' => array('plus' => 2021, 'minus' => 341),
                    'id302' => array('plus' => 102, 'minus' => 2301),
                    'id1234' => array('plus' => 302, 'minus' => 4201),
                    'id9821' => array('plus' => 202, 'minus' => 1101),
                    'id12345' => array('plus' => 2021, 'minus' => 341),
                    'id30232' => array('plus' => 102, 'minus' => 2301),
                    'id123462' => array('plus' => 302, 'minus' => 4201),
                    'id98211' => array('plus' => 202, 'minus' => 1101),
                    'id30239' => array('plus' => 102, 'minus' => 2301),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide1.jpg',
                'categories' => array('people', 'films'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-03 12:12:12',
                'published_date' => '2017-05-03 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 2031
            ),

            array(
                'title' => 'Najpiękniejsza polska aktorka',
                'slug' => 'Najpiękniejsza polska aktorka',
                'description' => 'W tym rankingu głosujemy na najlepszy polski film wszechczasów. Sprawa nie jest łatwa ponieważ polskie kindo od dziesiątek lat wypuszcza świetne produkcje. Jesteśmy niezmiernie ciekawi który film wygra w tym rankingu.',
                'items' => array('Jestem Mordercą', 'Bogowie', 'Pianista', 'Przesłuchanie', 'Wołyń', 'Amator', 'Twardowski 2.0', 'Pora umierać', 'Sami swoi'),
                'items_result' => array(
                    'id1' => array('plus' => 2021, 'minus' => 341),
                    'id302' => array('plus' => 102, 'minus' => 2301),
                    'id1234' => array('plus' => 302, 'minus' => 4201),
                    'id9821' => array('plus' => 202, 'minus' => 1101),
                    'id12345' => array('plus' => 2021, 'minus' => 341),
                    'id30232' => array('plus' => 102, 'minus' => 2301),
                    'id123462' => array('plus' => 302, 'minus' => 4201),
                    'id98211' => array('plus' => 202, 'minus' => 1101),
                    'id30239' => array('plus' => 102, 'minus' => 2301),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide1.jpg',
                'categories' => array('people', 'sport'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-02 12:12:12',
                'published_date' => NULL,
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 203
            ),

        );


        foreach($ranking_list as $details){

            $Ranking = new Ranking();

            $Ranking->setTitle($details['title'])
                ->setDescription($details['description'])
                ->setItems($details['items'])
                ->setItemsResult($details['items_result'])
                ->setThumbnail($details['thumbnail'])
                ->setAuthor($details['author'])
                ->setCreateDate(new \DateTime($details['create_date']))
                ->setMainSlider($details['main_slider'])
                ->setHomePage($details['home_page'])
                ->setNumbVisits($details['numb_visits']);

            if($details['published_date'] != NULL){
                $Ranking->setPublishedDate(new \DateTime($details['published_date']));
            }

            foreach( $details['categories'] as $category_name){
                $Ranking->addCategory($this->getReference('category_'.$category_name));
            }

            foreach( $details['tags'] as $tag_name){
                $Ranking->addTag($this->getReference('tag_'.$tag_name));
            }

            $manager->persist($Ranking);
        }

        $manager->flush();

    }

    public function getOrder(){
        return 1;
    }


}