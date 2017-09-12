<?php

namespace RankingowiecBundle\Repository;

use Doctrine\ORM\EntityRepository;


class RankObjectRepository extends EntityRepository{


    //Zwraca liste obiektow dla konkretnego rankingu [NIEAKTUALNE]
//    public function getRankingObjects(array $objectList = array()){
//
//        $qb = $this->getQueryBuilder(array());
//
//        foreach ($objectList as $id => $title) {
//            $qb->orWhere('o.title = :title_'.$id)
//                ->setParameter('title_'.$id, $title);
//
//        }
//
//        return $qb->getQuery()->getResult();
//
//    }

    //Zwraca obiekt o konkretnym slugu
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

        if(!empty($params['titleLike'])){
            $titleLike = '%'.$params['titleLike'].'%';
            $qb->andWhere('o.title LIKE :titleLike')
                ->setParameter('titleLike', $titleLike);
        }

        if(!empty($params['categoryId'])){
            if(-1 == $params['categoryId']){
                $qb->andWhere($qb->expr()->isNull('o.category'));
            }else{
                $qb->andWhere('c.id = :categoryId')
                    ->setParameter('categoryId', $params['categoryId']);
            }
        }

        return $qb;

    }

    //Zwraca tablicę z liczbami obiektów (z rozdzieleniem na opublikowane / nieopublikowane)
    public function getStatistics(){
        $qb = $this->createQueryBuilder('o')
            ->select('COUNT(o)');

        $all = (int)$qb->getQuery()->getSingleScalarResult();

        $published = (int)$qb->andWhere('o.published_date <= :currDate AND o.published_date IS NOT NULL')
            ->setParameter('currDate', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult();

        return array(
            'all' => $all,
            'published' => $published,
            'unpublished' => ($all - $published)
        );
    }


    //Funkcja zmieniająca kategorię obiektów (przy usuwaniu danej kategorii)
    public function moveToCategory($oldCategoryId, $newCategoryId){

        return $this->createQueryBuilder('o')
            ->update()
            ->set('o.category', ':newCategoryId')
            ->where('o.category = :oldCategoryId')
            ->setParameters(array(
                'newCategoryId' => $newCategoryId,
                'oldCategoryId' => $oldCategoryId
            ))
            ->getQuery()
            ->execute();
    }





}