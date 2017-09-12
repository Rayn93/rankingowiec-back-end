<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass="RankingowiecBundle\Repository\RankingItemRepository")
 * @ORM\Table(name="rankings_items")
 */
class RankingItem{


    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ranking", inversedBy="items")
     * @ORM\JoinColumn(name="ranking_id", referencedColumnName="id", nullable=false)
     */
    private $ranking;


    /**
     * @ORM\ManyToOne(targetEntity="RankObject", inversedBy="rankings")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id", nullable=false)
     */
    private $item;


    /**
     * @ORM\Column(type="integer")
     */
    private $plus;


    /**
     * @ORM\Column(type="integer")
     */
    private $minus;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set plus
     *
     * @param integer $plus
     *
     * @return RankingItem
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return integer
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * Set minus
     *
     * @param integer $minus
     *
     * @return RankingItem
     */
    public function setMinus($minus)
    {
        $this->minus = $minus;

        return $this;
    }

    /**
     * Get minus
     *
     * @return integer
     */
    public function getMinus()
    {
        return $this->minus;
    }

    /**
     * Set ranking
     *
     * @param \RankingowiecBundle\Entity\Ranking $ranking
     *
     * @return RankingItem
     */
    public function setRanking(\RankingowiecBundle\Entity\Ranking $ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Get ranking
     *
     * @return \RankingowiecBundle\Entity\Ranking
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set item
     *
     * @param \RankingowiecBundle\Entity\RankObject $item
     *
     * @return RankingItem
     */
    public function setItem(\RankingowiecBundle\Entity\RankObject $item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \RankingowiecBundle\Entity\RankObject
     */
    public function getItem()
    {
        return $this->item;
    }
}
