<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuildingRepository")
 */
class Building {

    public function __construct() {
        $this->floors = new ArrayCollection();
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
     * @ORM\Column(name="title", type="string", length=30, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var ArrayCollection building floors
     *
     * @ORM\OneToMany(targetEntity="Floor", mappedBy="building")
     */
    public $floors;

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
     * @return Building
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
     * @return Building
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
     * Add floor
     *
     * @param Floor $floor
     *
     * @return Building
     */
    public function addFloor(Floor $floor)
    {
        $this->floors[] = $floor;

        return $this;
    }

    /**
     * Remove floor
     *
     * @param Floor $floor
     */
    public function removeFloor(Floor $floor)
    {
        $this->floors->removeElement($floor);
    }

    /**
     * Get floors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFloors()
    {
        return $this->floors;
    }
}

