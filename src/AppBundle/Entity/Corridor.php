<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Corridor
 *
 * @ORM\Table(name="corridor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CorridorRepository")
 */
class Corridor
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
     *
     * @ORM\Column(name="title", type="string", length=30)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Floor the floor of the corridor
     *
     * @ORM\ManyToOne(targetEntity="Floor", inversedBy="corridors")
     * @Assert\NotBlank
     */
    public $floor;

    /**
     * @var HasConstraint
     *
     * @ORM\OneToOne(targetEntity="HasConstraint")
     */
    public $hasConstraint;


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
     * @return Corridor
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
     * @return Corridor
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
     * Set floor
     *
     * @param Floor $floor
     *
     * @return Corridor
     */
    public function setFloor(Floor $floor = null)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return Floor
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set hasConstraint.
     *
     * @param \AppBundle\Entity\HasConstraint|null $hasConstraint
     *
     * @return Corridor
     */
    public function setHasConstraint(\AppBundle\Entity\HasConstraint $hasConstraint = null)
    {
        $this->hasConstraint = $hasConstraint;

        return $this;
    }

    /**
     * Get hasConstraint.
     *
     * @return \AppBundle\Entity\HasConstraint|null
     */
    public function getHasConstraint()
    {
        return $this->hasConstraint;
    }
}
