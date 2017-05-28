<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankObjectRepository extends EntityRepository{


    //Zwraca liste obiektow dla konkretnego rankingu
    public function getRankingObjects(array $objectList = array()){

        $qb = $this->getQueryBuilder(array());

        foreach ($objectList as $id => $title) {
            $qb->orWhere('o.title = :title_'.$id)
                ->setParameter('title_'.$id, $title);

        }

        return $qb->getQuery()->getResult();

    }

    //Zwraca ranking o konkretnym slugu
    public function getPublishedObject($slug){

        $qb = $this->getQueryBuilder(array(
            'status' => 'published'
        ));

        $qb->andWhere('o.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();

    }


    //Tworzy zapytania DQL dla encji Obiektow rankiongowych z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('o')
            ->select('o, c')
            ->leftJoin('o.category', 'c');


        if(!empty($params['status'])){

            if($params['status'] == 'published'){
                $qb->where('o.published_date <= :curr_date AND o.published_date IS NOT NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
            else if($params['status'] == 'unpublished'){
                $qb->where('o.published_date > :curr_date OR o.published_date IS NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
        }

        return $qb;

    }





}