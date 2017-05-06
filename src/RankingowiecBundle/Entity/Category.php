<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
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


}