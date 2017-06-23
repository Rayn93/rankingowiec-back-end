<?php

namespace RankingowiecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * @ORM\Entity(repositoryClass="RankingowiecBundle\Repository\RankObjectRepository")
 * @ORM\Table(name="ranking_objects")
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity(fields={"title"})
 * @UniqueEntity(fields={"slug"})
 *
 * @Vich\Uploadable
 */
class RankObject{


    const DEFAULT_THUMBNAIL = 'default_thumbnail.jpg';
    const UPLOAD_DIR = 'uploads/thumbnails/';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=120, unique=true)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 120
     * )
     */
    private $title;


    /**
     * @ORM\Column(type="string", length=120, unique=true)
     *
     */
    private $slug;


    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=80)
     *
     */
    private $thumbnail;


    /**
     * @Vich\UploadableField(mapping="thumbnail_image", fileNameProperty="thumbnail")
     *
     *
     * @var File
     */
    private $thumbnailFile;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=120)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 120
     * )
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
     *
     * @Assert\DateTime
     */
    private $published_date;


    /**
     * @ORM\ManyToOne(
     *     targetEntity = "Category",
     *     inversedBy = "objects"
     * )
     *
     * @ORM\JoinColumn(
     *     name = "category_id",
     *     referencedColumnName = "id",
     *     onDelete = "SET NULL"
     * )
     */
    private $category;


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
     * @return RankObject
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
     * @return RankObject
     */
    public function setSlug($slug)
    {
        $this->slug = \RankingowiecBundle\Libs\Utils::sluggify($slug);

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
     * @return RankObject
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
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return RankObject
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
//        return $this->thumbnail;

        if($this->thumbnail == null ){
            return RankObject::DEFAULT_THUMBNAIL;
        }

        return $this->thumbnail;

    }


    public function setThumbnailFile(File $image = null)
    {
        $this->thumbnailFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }



    /**
     * Set moreLink
     *
     * @param string $moreLink
     *
     * @return RankObject
     */
    public function setMoreLink($moreLink)
    {
        $this->more_link = $moreLink;

        return $this;
    }

    /**
     * Get moreLink
     *
     * @return string
     */
    public function getMoreLink()
    {
        return $this->more_link;
    }

    /**
     * Set totalResult
     *
     * @param array $totalResult
     *
     * @return RankObject
     */
    public function setTotalResult($totalResult)
    {
        $this->total_result = $totalResult;

        return $this;
    }

    /**
     * Get totalResult
     *
     * @return array
     */
    public function getTotalResult()
    {
        return $this->total_result;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return RankObject
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
     * @return RankObject
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
     * @return RankObject
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
     * Set category
     *
     * @param \RankingowiecBundle\Entity\Category $category
     *
     * @return RankObject
     */
    public function setCategory(\RankingowiecBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \RankingowiecBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preSave(){

        if( $this->slug === NULL){
            $this->setSlug($this->getTitle());
        }

        if( $this->total_result === NULL){
            $this->total_result =  array(
                'plus' => 1,
                'minus' => 1
            );
        }

        if( $this->thumbnail === NULL){
            $this->thumbnail = 'default_thumbnail.jpg';
        }

        if($this->create_date === NULL){
            $this->create_date = new \DateTime();
        }

    }
}
