<?php

namespace LesPolypodes\RestOAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 */
class Author
{

    /**
     * @var integer
     * @Type("integer")
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Author"})
     */
    private $id;

    /**
     * @var string
     * @Type("string")
     *
     * @orm\column(name="firstname", type="string", length=255, nullable=false)
     * @expose
     * @groups({"author"})
     */
    private $firstname;

    /**
     * @var string
     * @Type("string")
     *
     * @orm\column(name="lastname", type="string", length=255, nullable=false)
     * @expose
     * @groups({"author"})
     */
    private $lastname;

    /**
     * var @var ArrayCollection<Book> books
     * @Type("ArrayCollection<LesPolypodes\RestOAuthBundle\Entity\Book>")
     *
     * @ORM\OneToMany(targetEntity="Book", mappedBy="author", cascade={"remove", "persist"})
     * @expose
     * @groups({"author"})
     */

    private $books;

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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set firstname
     *
     * @param  string $firstname
     * @return Author
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set lastname
     *
     * @param  string $lastname
     * @return Author
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return sprintf("%s %s", $this->firstname, $this->lastname);
    }

    /**
     * Add books
     *
     * @param  \LesPolypodes\RestOAuthBundle\Entity\Book $book
     * @return Author
     */
    public function addBook(\LesPolypodes\RestOAuthBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove books
     *
     * @param \LesPolypodes\RestOAuthBundle\Entity\Book $book
     */
    public function removeBook(\LesPolypodes\RestOAuthBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Author
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Author
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
}
