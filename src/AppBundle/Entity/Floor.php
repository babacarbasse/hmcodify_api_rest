<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Floor
 *
 * @ORM\Table(name="floor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FloorRepository")
 */
class Floor
{
    public function __construct() {
        $this->corridors = new ArrayCollection();
    }

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var Building the building of the floor
     *
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="floors")
     * @Assert\NotBlank
     */
    public $building;

    /**
     * @var ArrayCollection building floors
     *
     * @ORM\OneToMany(targetEntity="Corridor", mappedBy="floor")
     */
    private $corridors;

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
     * Set description
     *
     * @param string $description
     *
     * @return Floor
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
     * Set number
     *
     * @param integer $number
     *
     * @return Floor
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set building
     *
     * @param Building $building
     *
     * @return Floor
     */
    public function setBuilding(Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return Building
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Add corridor
     *
     * @param Corridor $corridor
     *
     * @return Floor
     */
    public function addCorridor(Corridor $corridor)
    {
        $this->corridors[] = $corridor;

        return $this;
    }

    /**
     * Remove corridor
     *
     * @param Corridor $corridor
     */
    public function removeCorridor(Corridor $corridor)
    {
        $this->corridors->removeElement($corridor);
    }

    /**
     * Get corridors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCorridors()
    {
        return $this->corridors;
    }

    /**
     * Set hasConstraint.
     *
     * @param \AppBundle\Entity\HasConstraint|null $hasConstraint
     *
     * @return Floor
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
