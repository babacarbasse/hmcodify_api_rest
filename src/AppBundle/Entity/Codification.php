<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
