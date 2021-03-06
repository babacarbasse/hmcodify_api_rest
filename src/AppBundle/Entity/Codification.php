<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Codification
 *
 * @ORM\Table(name="codification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CodificationRepository")
 */
class Codification
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCodification", type="datetime")
     */
    private $dateCodification;

    /**
     * @var Position
     *
     * @ORM\OneToOne(targetEntity="Position", mappedBy="codification")
     *
     * @Assert\NotBlank
     */
    public $position;

    /**
     * @var Student
     *
     * @ORM\OneToOne(targetEntity="Student", inversedBy="codification")
     *
     * @Assert\NotBlank
     */
    public $student;

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
     * Set dateCodification.
     *
     * @param \DateTime $dateCodification
     *
     * @return Codification
     */
    public function setDateCodification($dateCodification)
    {
        $this->dateCodification = $dateCodification;

        return $this;
    }

    /**
     * Get dateCodification.
     *
     * @return \DateTime
     */
    public function getDateCodification()
    {
        return $this->dateCodification;
    }

    /**
     * Set position.
     *
     * @param \AppBundle\Entity\Position|null $position
     *
     * @return Codification
     */
    public function setPosition(\AppBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return \AppBundle\Entity\Position|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set student.
     *
     * @param \AppBundle\Entity\Student|null $student
     *
     * @return Codification
     */
    public function setStudent(\AppBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student.
     *
     * @return \AppBundle\Entity\Student|null
     */
    public function getStudent()
    {
        return $this->student;
    }
}
