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


    /**
     * @ORM\ManyToMany(
     *     targetEntity = "Category",
     *     inversedBy = "rankings"
     * )
     *
     * @ORM\JoinTable(
     *     name = "rankings_categories"
     * )
     */
    private $categories;


    /**
     * @ORM\ManyToMany(
     *     targetEntity = "Tag",
     *     inversedBy = "rankings"
     * )
     *
     * @ORM\JoinTable(
     *     name = "rankings_tags"
     * )
     */
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



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Ranking
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Ranking
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ranking
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set items
     *
     * @param integer $items
     *
     * @return Ranking
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return integer
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set itemsResult
     *
     * @param array $itemsResult
     *
     * @return Ranking
     */
    public function setItemsResult($itemsResult)
    {
        $this->items_result = $itemsResult;

        return $this;
    }

    /**
     * Get itemsResult
     *
     * @return array
     */
    public function getItemsResult()
    {
        return $this->items_result;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return Ranking
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Ranking
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Ranking
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set publishedDate
     *
     * @param \DateTime $publishedDate
     *
     * @return Ranking
     */
    public function setPublishedDate($publishedDate)
    {
        $this->published_date = $publishedDate;

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->published_date;
    }

    /**
     * Set mainSlider
     *
     * @param boolean $mainSlider
     *
     * @return Ranking
     */
    public function setMainSlider($mainSlider)
    {
        $this->main_slider = $mainSlider;

        return $this;
    }

    /**
     * Get mainSlider
     *
     * @return boolean
     */
    public function getMainSlider()
    {
        return $this->main_slider;
    }

    /**
     * Set homePage
     *
     * @param boolean $homePage
     *
     * @return Ranking
     */
    public function setHomePage($homePage)
    {
        $this->home_page = $homePage;

        return $this;
    }

    /**
     * Get homePage
     *
     * @return boolean
     */
    public function getHomePage()
    {
        return $this->home_page;
    }

    /**
     * Set numbVisits
     *
     * @param integer $numbVisits
     *
     * @return Ranking
     */
    public function setNumbVisits($numbVisits)
    {
        $this->numb_visits = $numbVisits;

        return $this;
    }

    /**
     * Get numbVisits
     *
     * @return integer
     */
    public function getNumbVisits()
    {
        return $this->numb_visits;
    }

    /**
     * Add category
     *
     * @param \RankingowiecBundle\Entity\Category $category
     *
     * @return Ranking
     */
    public function addCategory(\RankingowiecBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \RankingowiecBundle\Entity\Category $category
     */
    public function removeCategory(\RankingowiecBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add tag
     *
     * @param \RankingowiecBundle\Entity\Tag $tag
     *
     * @return Ranking
     */
    public function addTag(\RankingowiecBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \RankingowiecBundle\Entity\Tag $tag
     */
    public function removeTag(\RankingowiecBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
