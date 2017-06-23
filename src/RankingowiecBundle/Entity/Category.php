<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="RankingowiecBundle\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category extends AbstractTaxonomy {



    /**
     * @ORM\ManyToMany(
     *     targetEntity = "Ranking",
     *     mappedBy = "categories"
     * )
     */
    protected $rankings;


    /**
     * @ORM\OneToMany(
     *     targetEntity = "RankObject",
     *     mappedBy = "category"
     * )
     */
    private $objects;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rankings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ranking
     *
     * @param \RankingowiecBundle\Entity\Ranking $ranking
     *
     * @return Category
     */
    public function addRanking(\RankingowiecBundle\Entity\Ranking $ranking)
    {
        $this->rankings[] = $ranking;

        return $this;
    }

    /**
     * Remove ranking
     *
     * @param \RankingowiecBundle\Entity\Ranking $ranking
     */
    public function removeRanking(\RankingowiecBundle\Entity\Ranking $ranking)
    {
        $this->rankings->removeElement($ranking);
    }

    /**
     * Get rankings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRankings()
    {
        return $this->rankings;
    }

    /**
     * Add object
     *
     * @param \RankingowiecBundle\Entity\RankObject $object
     *
     * @return Category
     */
    public function addObject(\RankingowiecBundle\Entity\RankObject $object)
    {
        $this->objects[] = $object;

        return $this;
    }

    /**
     * Remove object
     *
     * @param \RankingowiecBundle\Entity\RankObject $object
     */
    public function removeObject(\RankingowiecBundle\Entity\RankObject $object)
    {
        $this->objects->removeElement($object);
    }

    /**
     * Get objects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjects()
    {
        return $this->objects;
    }
}
