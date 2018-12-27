<?php

namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="adminBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="merci de remplir ce champs{* ce champs obligatoire !}")
     * @ORM\Column(name="title", type="string", length=120)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(message="merci de remplir ce champs{* ce champs obligatoire !}")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="merci de remplir ce champs{* ce champs obligatoire !}")
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     * 
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="merci de remplir ce champs{* ce champs obligatoire !}")
     * @ORM\Column(name="datepublish", type="datetime", nullable=true)
     */
    private $datepublish;

    /**    
     * @ORM\ManyToMany(targetEntity="adminBundle\Entity\category")
     */
    private $categories;

    /**
     * @ORM\Column(type="string")     
     * @Assert\NotBlank(groups={"new"}, message="merci de remplir ce champs{* ce champs obligatoire !}")
     * @Assert\File(mimeTypes={"image/png", "image/jpeg"})
     */
    private $image;

    /**
     * Get id
     *
     * @return int
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
     * @return Post
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
     * Set description
     *
     * @param string $description
     *
     * @return Post
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
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
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
     * Set datepublish
     *
     * @param \DateTime $datepublish
     *
     * @return Post
     */
    public function setDatepublish($datepublish)
    {
        $this->datepublish = $datepublish;

        return $this;
    }

    /**
     * Get datepublish
     *
     * @return \DateTime
     */
    public function getDatepublish()
    {
        return $this->datepublish;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \adminBundle\Entity\category $category
     *
     * @return Post
     */
    public function addCategory(\adminBundle\Entity\category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \adminBundle\Entity\category $category
     */
    public function removeCategory(\adminBundle\Entity\category $category)
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
     * Set image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
