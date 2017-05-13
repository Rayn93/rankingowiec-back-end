<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankingRepository extends EntityRepository{


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

        return $qb;

    }





}