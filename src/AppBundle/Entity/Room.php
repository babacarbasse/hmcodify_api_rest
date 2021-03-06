<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{

    public function __construct() {
        $this->positions = new ArrayCollection();
        $this->positionsTaken = new ArrayCollection();
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
     * @var int
     *
     * @ORM\Column(name="occupancyLimit", type="integer")
     */
    private $occupancyLimit;

    /**
     * @var string
     *
     * @ORM\Column(name="reservedBy", type="string", length=60)
     */
    private $reservedBy;

    /**
     * @var ArrayCollection room taken positions
     *
     * @ORM\ManyToMany(targetEntity="Position")
     * @ORM\JoinTable(name="postiontaken",
     *     joinColumns={@ORM\JoinColumn(name="room_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $positionsTaken;


    /**
     * @var ArrayCollection room positions
     *
     * @ORM\OneToMany(targetEntity="Position", mappedBy="room")
     */
    private $positions;

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
     * Set occupancyLimit
     *
     * @param integer $occupancyLimit
     *
     * @return Room
     */
    public function setOccupancyLimit($occupancyLimit)
    {
        $this->occupancyLimit = $occupancyLimit;

        return $this;
    }

    /**
     * Get occupancyLimit
     *
     * @return int
     */
    public function getOccupancyLimit()
    {
        return $this->occupancyLimit;
    }

    /**
     * Set reservedBy
     *
     * @param string $reservedBy
     *
     * @return Room
     */
    public function setReservedBy($reservedBy)
    {
        $this->reservedBy = $reservedBy;

        return $this;
    }

    /**
     * Get reservedBy
     *
     * @return string
     */
    public function getReservedBy()
    {
        return $this->reservedBy;
    }

    /**
     * Add position
     *
     * @param Position $position
     *
     * @return Room
     */
    public function addPosition(Position $position)
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param Position $position
     */
    public function removePosition(Position $position)
    {
        $this->positions->removeElement($position);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }


    /**
     * Add positionsTaken
     *
     * @param Position $positionsTaken
     *
     * @return Room
     */
    public function addPositionsTaken(Position $positionsTaken)
    {
        $this->positionsTaken[] = $positionsTaken;

        return $this;
    }

    /**
     * Remove positionsTaken
     *
     * @param Position $positionsTaken
     */
    public function removePositionsTaken(Position $positionsTaken)
    {
        $this->positionsTaken->removeElement($positionsTaken);
    }

    /**
     * Get positionsTaken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositionsTaken()
    {
        return $this->positionsTaken;
    }

    /**
     * Set hasConstraint.
     *
     * @param \AppBundle\Entity\HasConstraint|null $hasConstraint
     *
     * @return Room
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
