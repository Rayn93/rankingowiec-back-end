<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankingItemRepository extends EntityRepository{


//    Zwraca liste obiektow dla konkretnego rankingu
    public function getRankingObjects($Rankingid){

        $qb = $this->createQueryBuilder('i')
                ->select('i')
                ->where('i.ranking = :rankingId')
                ->setParameter('rankingId', $Rankingid)
                ->orderBy('i.plus - i.minus', 'DESC');;

//        foreach ($objectList as $id => $title) {
//            $qb->orWhere('o.title = :title_'.$id)
//                ->setParameter('title_'.$id, $title);
//
//        }

//        $qb->andWhere('i.id = :rankingId')
//            ->setParameter('rankingId', $Rankingid);

        return $qb->getQuery()->getResult();

    }



    //Tworzy zapytania DQL dla encji RankingItem z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('i')
            ->select('i, r, it')
            ->leftJoin('i.ranking', 'r')
            ->leftJoin('i.item', 'it');


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