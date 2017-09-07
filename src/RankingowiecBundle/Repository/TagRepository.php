<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class TagRepository extends EntityRepository{



    //Tworzy zapytania DQL dla encji Tag z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('t')
            ->select('t.name, t.slug');


        if(!empty($params['limit'])){
            $qb->setMaxResults($params['limit']);
        }


        if(!empty($params['random']) && $params['random'] == true){
            $qb->addSelect('RAND() as HIDDEN rand')->orderBy('rand');
        }

        if(!empty($params['countRankings'])){
            $qb->addSelect('t, COUNT(r.id) as rankingsCount')
                ->leftJoin('t.rankings', 'r')
                ->groupBy('t.id');
        }

        return $qb;

    }





}