<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
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

}