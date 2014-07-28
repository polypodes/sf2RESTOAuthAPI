<?php
/**
 * Created by PhpStorm.
 * User: ronan
 * Date: 28/07/2014
 * Time: 15:42
 */

namespace LesPolypodes\sf2RestOAuthBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Book
 *
 * @ORM\Table(name="reference__book")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 *
 */
class Book
{

    /**
     * @var integer
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
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=255, nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $clientName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Expose
     * @Groups({"Book"})
     */
    private $createdAt;

    /**
     * @var \DateTime
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

}