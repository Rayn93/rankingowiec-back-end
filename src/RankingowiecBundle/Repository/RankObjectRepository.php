<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankObjectRepository extends EntityRepository{


    //Z
    public function getRankingObjects(array $objectList = array()){

        $qb = $this->getQueryBuilder(array());

        foreach ($objectList as $id => $title) {
            $qb->orWhere('o.title = :title_'.$id)
                ->setParameter('title_'.$id, $title);

        }




        return $qb->getQuery()->getResult();

    }


    //Tworzy zapytania DQL dla encji Ranking z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('o')
            ->select('o');


//        //Sprawdza status rankingu w zależności od przekazanego parametru published / unpublished
//        if(!empty($params['status'])){
//
//            if($params['status'] == 'published'){
//                $qb->where('r.published_date <= :curr_date AND r.published_date IS NOT NULL')
//                    ->setParameter('curr_date', new \DateTime());
//            }
//            else if($params['status'] == 'unpublished'){
//                $qb->where('r.published_date > :curr_date OR r.published_date IS NULL')
//                    ->setParameter('curr_date', new \DateTime());
//            }
//        }


//        if(!empty($params['orderBy'])){
//            $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
//            $qb->orderBy($params['orderBy'], $orderDir);
//        }
//
//        if(!empty($params['categorySlug'])){
//            $qb->andWhere('c.slug = :categorySlug')
//                ->setParameter('categorySlug', $params['categorySlug']);
//        }
//
//        if(!empty($params['tagSlug'])){
//            $qb->andWhere('t.slug = :tagSlug')
//                ->setParameter('tagSlug', $params['tagSlug']);
//        }
//
//        if(!empty($params['slider']) && $params['slider'] == true){
//            $qb->andWhere('r.main_slider = true');
//        }
//
//        if(!empty($params['limit'])){
//            $qb->setMaxResults($params['limit']);
//        }
//
//        if(!empty($params['home_page']) && $params['home_page'] == true){
//            $qb->andWhere('r.home_page = true');
//        }
//
//        if(!empty($params['random']) && $params['random'] == true){
//            $qb->addSelect('RAND() as HIDDEN rand')->orderBy('rand');
//        }
//
//        if(!empty($params['search_param'])) {
//            $searchParameter = '%'.$params['search_param'].'%';
//            $qb->andWhere('r.title LIKE :searchParameter OR r.description LIKE :searchParameter')
//                ->setParameter('searchParameter', $searchParameter);
//        }

        return $qb;

    }





}