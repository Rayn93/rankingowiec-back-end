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
                'thumbnail' => 'http://rankingowiec.dev/img/static_backgroud.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Kontakt',
                'slug' => 'Kontakt',
                'content' => ' polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa?',
                'thumbnail' => 'http://rankingowiec.dev/img/static_backgroud.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => NULL,
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Najczęściej zadawane pytania',
                'slug' => 'FAQ',
                'content' => ' <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Jak liczone są pozycje w rankingach?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Jak mogę zaproponować nową pozycję w rankingu?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Czy mogę stworzyć swój własny ranking?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>',
                'thumbnail' => 'http://rankingowiec.dev/img/static_backgroud.jpg',
                'create_date' => '2017-02-01 12:12:12',
                'published_date' => '2017-02-01 12:12:12',
                'author' => 'Robert Saternus'
            ),

            array(
                'title' => 'Jak to działa',
                'slug' => 'Jak to działa',
                'content' => '<p> polski film fabularny z 2016 w reżyserii Macieja Pieprzycy, inspirowany historią Zdzisława Marchwickiego, domniemanego „wampira z Zagłębia”, ukazaną w realiach Polski Ludowej lat 70. Film jest inspirowany prawdziwymi wydarzeniami z początku lat 70. XX w. Główny bohater filmu, Janusz Jasiński, jest młodym porucznikiem milicji. Po kolejnych niepowodzeniach dotychczasowego śledztwa w sprawie brutalnych zabójstw kobiet zostaje mianowany nowym szefem grupy dochodzeniowej. Stara się zrobić wszystko, by wykorzystać życiową szansę i złapać seryjnego mordercę. Jak wiele będzie w stanie poświęcić dla śledztwa? </p>',
                'thumbnail' => 'http://rankingowiec.dev/img/static_backgroud.jpg',
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
                ->setSlug($details['slug'])
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