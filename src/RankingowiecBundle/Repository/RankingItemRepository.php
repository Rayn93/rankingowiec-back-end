<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankingItemRepository extends EntityRepository{


//    Zwraca liste obiektow dla konkretnego rankingu
    public function getRankingObjects($Rankingid){

        $qb = $this->getQueryBuilder();

        $qb     ->andwhere('i.ranking = :rankingId')
                ->setParameter('rankingId', $Rankingid)
                ->orderBy('i.plus - i.minus', 'DESC');

        return $qb->getQuery()->getResult();

    }

    //Zwraca wszystkie rankingi z obiektem o podanym ID
    public function getRankingsWithItem($ItemId){

        $qb = $this->getQueryBuilder(array(
            'status' => 'published'
        ));

        $qb->andWhere('i.item = :itemId')
            ->setParameter('itemId', $ItemId)
            ->distinct();

        return $qb->getQuery()->getResult();

    }



    //Tworzy zapytania DQL dla encji RankingItem z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('i')
            ->select('i, r, it')
            ->leftJoin('i.ranking', 'r')
            ->leftJoin('i.item', 'it');


        if(!empty($params['status'])){

            if($params['status'] == 'published'){
                $qb->where('it.published_date <= :curr_date AND it.published_date IS NOT NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
            else if($params['status'] == 'unpublished'){
                $qb->where('it.published_date > :curr_date OR it.published_date IS NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
        }


        return $qb;

    }

    //Zwraca tablicę z liczbami rankingów (z rozdzieleniem na opublikowane / nieopublikowane)
    public function getStatistics(){
        $qb = $this->createQueryBuilder('r')
            ->select('COUNT(r)');

        $all = (int)$qb->getQuery()->getSingleScalarResult();

        $published = (int)$qb->andWhere('r.published_date <= :currDate AND r.published_date IS NOT NULL')
            ->setParameter('currDate', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult();

        return array(
            'all' => $all,
            'published' => $published,
            'unpublished' => ($all - $published)
        );
    }


}