<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class PageRepository extends EntityRepository{




    //Tworzy zapytania DQL dla encji Stron statycznych z przekazanymi parametrami
    public function getQueryBuilder(array $params = array()){

        $qb = $this->createQueryBuilder('p')
            ->select('p');


        if(!empty($params['status'])){

            if($params['status'] == 'published'){
                $qb->where('p.published_date <= :curr_date AND p.published_date IS NOT NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
            else if($params['status'] == 'unpublished'){
                $qb->where('p.published_date > :curr_date OR p.published_date IS NULL')
                    ->setParameter('curr_date', new \DateTime());
            }
        }

        if(!empty($params['titleLike'])){
            $titleLike = '%'.$params['titleLike'].'%';
            $qb->andWhere('p.title LIKE :titleLike')
                ->setParameter('titleLike', $titleLike);
        }

        return $qb;

    }

    //Zwraca tablicę z liczbami stron (z rozdzieleniem na opublikowane / nieopublikowane)
    public function getStatistics(){
        $qb = $this->createQueryBuilder('p')
            ->select('COUNT(p)');

        $all = (int)$qb->getQuery()->getSingleScalarResult();

        $published = (int)$qb->andWhere('p.published_date <= :currDate AND p.published_date IS NOT NULL')
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