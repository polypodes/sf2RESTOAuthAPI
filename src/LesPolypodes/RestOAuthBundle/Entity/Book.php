<?php

namespace LesPolypodes\RestOAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 */
class Book
{

    /**
     * @var integer
     * @Type("integer")
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Book"})
     */
    private $id;

    /**
     * @var string
     * @Type("string")
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $title;

    /**
     * @var string
     * @Type("string")
     *
     * @ORM\Column(name="isbn", type="string", length=255, nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $isbn;

    /**
     * @var Author $author
     * @Type("LesPolypodes\RestOAuthBundle\Entity\Author")
     *
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="books", cascade={"remove"})
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * @Expose
     * @Groups({"Book"})
     */
    private $author;

    /**
     * @var \DateTime
     * @Type("DateTime")
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Type("DateTime")
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Expose
     * @Groups({"Book"})
     */
    private $updatedAt;

    public function prePersist()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = $this->createdAt;

    }

    public function preUpdate()
    {
        $this->updatedAt = new \DateTime;

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientName
     *
     * @param  string $clientName
     * @return Book
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  \DateTime $date
     * @return Book
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Book
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Book
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set author
     *
     * @param \LesPolypodes\RestOAuthBundle\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\LesPolypodes\RestOAuthBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \LesPolypodes\RestOAuthBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
