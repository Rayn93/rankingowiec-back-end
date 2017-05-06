<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="ranking_objects")
 */
class RankObject{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $title;


    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $slug;


    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=80)
     */
    private $thumbnail;


    /**
     * @ORM\Column(type="string", length=120)
     */
    private $more_link;


    /**
     * @ORM\Column(type="simple_array")
     */
    private $total_result;


    /**
     * @ORM\Column(type="string", length=120)
     */
    private $author;


    /**
     * @ORM\Column(type="datetime")
     */
    private $create_date;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $published_date;



    private $category;

}