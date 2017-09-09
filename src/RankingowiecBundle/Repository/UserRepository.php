<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository{

    //Tworzy zapytania DQL dla encji Stron statycznych z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('u')
            ->select('u');

        if(!empty($params['usernameLike'])){
            $usernameLike = '%'.$params['usernameLike'].'%';
            $qb->andWhere('u.username LIKE :usernameLike')
                ->setParameter('usernameLike', $usernameLike);
        }

        return $qb;

    }

}