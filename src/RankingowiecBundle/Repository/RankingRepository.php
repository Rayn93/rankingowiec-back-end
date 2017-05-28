<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankingRepository extends EntityRepository{




    //Zwraca ranking o konkretnym slugu
    public function getPublishedRanking($slug){

        $qb = $this->getQueryBuilder(array(
            'status' => 'published'
        ));

        $qb->andWhere('r.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();

    }

    //Zwraca wszystkie rankingi z obiektem o podanym tytule
    public function getRankingsWithObject($title){

        $qb = $this->getQueryBuilder(array(
            'status' => 'published'
        ));

        $objectTitle = '%'.$title.'%';

        $qb->andWhere('r.items LIKE :objectTitle')
            ->setParameter('objectTitle', $objectTitle);

        return $qb->getQuery()->getResult();

    }


    //Tworzy zapytania DQL dla encji Ranking z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('r')
            ->select('r, c, t')
            ->leftJoin('r.categories', 'c')
            ->leftJoin('r.tags', 't');


        //Sprawdza status rankingu w zależności od przekazanego parametru published / unpublished
        if(!empty($params['status'])){

            if($params['status'] == 'published'){
                $qb->where('r.published_date <= :curr_date AND r.published_date IS NOT NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
            else if($params['status'] == 'unpublished'){
                $qb->where('r.published_date > :curr_date OR r.published_date IS NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
        }


        if(!empty($params['orderBy'])){
            $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
            $qb->orderBy($params['orderBy'], $orderDir);
        }

        if(!empty($params['categorySlug'])){
            $qb->andWhere('c.slug = :categorySlug')
                ->setParameter('categorySlug', $params['categorySlug']);
        }

        if(!empty($params['tagSlug'])){
            $qb->andWhere('t.slug = :tagSlug')
                ->setParameter('tagSlug', $params['tagSlug']);
        }

        if(!empty($params['slider']) && $params['slider'] == true){
            $qb->andWhere('r.main_slider = true');
        }

        if(!empty($params['limit'])){
            $qb->setMaxResults($params['limit']);
        }

        if(!empty($params['home_page']) && $params['home_page'] == true){
            $qb->andWhere('r.home_page = true');
        }

        if(!empty($params['random']) && $params['random'] == true){
            $qb->addSelect('RAND() as HIDDEN rand')->orderBy('rand');
        }

        if(!empty($params['search_param'])) {
            $searchParameter = '%'.$params['search_param'].'%';
            $qb->andWhere('r.title LIKE :searchParameter OR r.description LIKE :searchParameter')
                ->setParameter('searchParameter', $searchParameter);
        }

        if(!empty($params['only_new']) && $params['only_new'] == true){

            $next_month = new \DateTime('-30 days');
            $qb->andWhere('r.published_date > :next_month')
                ->setParameter('next_month', $next_month);
        }



        return $qb;

    }





}