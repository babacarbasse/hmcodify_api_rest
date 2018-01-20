<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HasConstraint
 *
 * @ORM\Table(name="has_constraint")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HasConstraintRepository")
 */
class HasConstraint
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
     * @ORM\Column(name="genderOccupation", type="string", length=10)
     */
    private $genderOccupation;

    /**
     * @var string
     *
     * @ORM\Column(name="optionOccupation", type="string", length=30)
     */
    private $optionOccupation;

    /**
     * @var string
     *
     * @ORM\Column(name="departementOccupation", type="string", length=30)
     */
    private $departementOccupation;

    /**
     * @var string
     *
     * @ORM\Column(name="classLevelOccupation", type="string", length=30)
     */
    private $classLevelOccupation;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set genderOccupation.
     *
     * @param string $genderOccupation
     *
     * @return HasConstraint
     */
    public function setGenderOccupation($genderOccupation)
    {
        $this->genderOccupation = $genderOccupation;

        return $this;
    }

    /**
     * Get genderOccupation.
     *
     * @return string
     */
    public function getGenderOccupation()
    {
        return $this->genderOccupation;
    }

    /**
     * Set optionOccupation.
     *
     * @param string $optionOccupation
     *
     * @return HasConstraint
     */
    public function setOptionOccupation($optionOccupation)
    {
        $this->optionOccupation = $optionOccupation;

        return $this;
    }

    /**
     * Get optionOccupation.
     *
     * @return string
     */
    public function getOptionOccupation()
    {
        return $this->optionOccupation;
    }

    /**
     * Set departementOccupation.
     *
     * @param string $departementOccupation
     *
     * @return HasConstraint
     */
    public function setDepartementOccupation($departementOccupation)
    {
        $this->departementOccupation = $departementOccupation;

        return $this;
    }

    /**
     * Get departementOccupation.
     *
     * @return string
     */
    public function getDepartementOccupation()
    {
        return $this->departementOccupation;
    }

    /**
     * Set classLevelOccupation.
     *
     * @param string $classLevelOccupation
     *
     * @return HasConstraint
     */
    public function setClassLevelOccupation($classLevelOccupation)
    {
        $this->classLevelOccupation = $classLevelOccupation;

        return $this;
    }

    /**
     * Get classLevelOccupation.
     *
     * @return string
     */
    public function getClassLevelOccupation()
    {
        return $this->classLevelOccupation;
    }
}
