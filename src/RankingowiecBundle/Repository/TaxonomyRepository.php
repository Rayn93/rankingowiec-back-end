<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class TaxonomyRepository extends EntityRepository {
    
    public function getQueryBuilder(array $params = array()) {
        $qb = $this->createQueryBuilder('t');
        
        $qb->select('t, COUNT(r.id) as rankingsCount')
                ->leftJoin('t.rankings', 'r')
                ->groupBy('t.id');
        
        return $qb;
    }
    
    public function getAsArray() {
        return $this->createQueryBuilder('t')
                        ->select('t.id, t.name')
                        ->getQuery()
                        ->getArrayResult();
    }
    
}
