<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category extends AbstractTaxonomy {

    private $objects;


}