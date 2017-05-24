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
                'categories' => array('people', 'films', 'popular'),
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide4.jpg',
                'categories' => array('people', 'films', 'popular'),
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
                'items' => array('Jestem mordercą [2016]', 'Sami Swoi [1986]', 'Bogowie [2015]', 'Pianista [2000]', 'Wołyń [2016]', 'Amator [1999]', 'Twardowski 2.0 [2014]', 'Pora umierać [1982]', 'Sami swoi [1972]'),
                'items_result' => array(
                    'Jestem mordercą [2016]' => array('plus' => 2021, 'minus' => 341),
                    'Sami Swoi [1986]' => array('plus' => 102, 'minus' => 2301),
                    'Bogowie [2015]' => array('plus' => 302, 'minus' => 4201),
                    'Pianista [2000]' => array('plus' => 202, 'minus' => 1101),
                    'Wołyń [2016]' => array('plus' => 8021, 'minus' => 2341),
                    'Amator [1999]' => array('plus' => 102, 'minus' => 2301),
                    'Twardowski 2.0 [2014]' => array('plus' => 302, 'minus' => 4201),
                    'Pora umierać [1982]' => array('plus' => 202, 'minus' => 1101),
                    'Sami swoi [1972]' => array('plus' => 102, 'minus' => 2301),
                ),
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide3.jpg',
                'categories' => array('people', 'films', 'popular'),
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide2.jpg',
                'categories' => array('people', 'films', 'popular' ),
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
                'categories' => array('people', 'sport', 'popular'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-02 12:12:12',
                'published_date' => NULL,
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 203
            ),

            array(
                'title' => 'Najlepszy polski bramkarz wszchczasów',
                'slug' => 'Najlepszy polski bramkarz wszchczasów',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide3.jpg',
                'categories' => array('people', 'sport'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-02 12:12:12',
                'published_date' => '2017-05-08 12:12:12',
                'main_slider' => false,
                'home_page' => true,
                'numb_visits' => 1203
            ),

            array(
                'title' => 'Moje ulubione piwo',
                'slug' => 'Moje ulubione piwo',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide3.jpg',
                'categories' => array('popular', 'sport'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-05-02 12:12:12',
                'published_date' => NULL,
                'main_slider' => false,
                'home_page' => false,
                'numb_visits' => 103
            ),

            array(
                'title' => 'Najlepsze zwierze do domu',
                'slug' => 'Najlepsze zwierze do domu',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide4.jpg',
                'categories' => array('popular', 'people'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-04-02 12:12:12',
                'published_date' => '2017-04-09 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 103
            ),

            array(
                'title' => 'Mój ulubiony yutuber',
                'slug' => 'Mój ulubiony yutuber',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide2.jpg',
                'categories' => array('sport', 'people'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-04-02 12:12:12',
                'published_date' => '2017-04-09 12:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 11203
            ),

            array(
                'title' => 'Najlepszy przedmiot w szkole',
                'slug' => 'Najlepszy przedmiot w szkole',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide4.jpg',
                'categories' => array('sport', 'people', 'popular'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-02-02 11:12:12',
                'published_date' => '2017-02-09 17:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 903
            ),

            array(
                'title' => 'Najlepszy trener reprezentacji polski',
                'slug' => 'Najlepszy trener reprezentacji polski',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide2.jpg',
                'categories' => array('sport', 'people', 'popular'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-02-02 11:12:12',
                'published_date' => '2017-02-09 17:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 903
            ),

            array(
                'title' => 'Sport, który uwielbiam oglądać',
                'slug' => 'Sport, który uwielbiam oglądać',
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
                'thumbnail' => 'http://rankingowiec.dev/img/slajdy/slide0.jpg',
                'categories' => array('sport', 'people', 'popular'),
                'tags' => array('najlepszy', 'polskie'),
                'author' => 'Robert Saternus',
                'create_date' => '2017-02-02 11:12:12',
                'published_date' => '2017-02-09 17:12:12',
                'main_slider' => true,
                'home_page' => true,
                'numb_visits' => 903
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