<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="RankingowiecBundle\Repository\TagRepository")
 * @ORM\Table(name="tags")
 */
class Tag extends AbstractTaxonomy {


    /**
     * @ORM\ManyToMany(
     *     targetEntity = "Ranking",
     *     mappedBy = "tags"
     * )
     */
    protected $rankings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rankings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ranking
     *
     * @param \RankingowiecBundle\Entity\Ranking $ranking
     *
     * @return Tag
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
}
