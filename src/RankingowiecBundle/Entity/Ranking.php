<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="rankings")
 */
class Ranking{

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
     * @ORM\Column(type="integer")
     */
    private $items;


    /**
     * @ORM\Column(type="json_array")
     */
    private $items_result;


    /**
     * @ORM\Column(type="string", length=80)
     */
    private $thumbnail;


    private $categories;
    private $tags;


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
    private $published_date = null;


    /**
     * @ORM\Column(type="boolean")
     */
    private $main_slider;


    /**
     * @ORM\Column(type="boolean")
     */
    private $home_page;


    /**
     * @ORM\Column(type="bigint")
     */
    private $numb_visits;



}