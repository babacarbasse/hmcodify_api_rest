<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student
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
     * @ORM\Column(name="ine", type="string", length=25, unique=true)
     */
    private $ine;

    /**
     * @var string
     *
     * @ORM\Column(name="cni", type="string", length=25, unique=true)
     */
    private $cni;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=30)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=30)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="birthPlace", type="string", length=45)
     */
    private $birthPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length=45)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="optionFormation", type="string", length=45)
     */
    private $optionFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="levelFormation", type="string", length=20)
     */
    private $levelFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=20, unique=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=45)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10)
     */
    private $gender;

    /**
     * @var Codification
     *
     * @ORM\OneToOne(targetEntity="Codification", mappedBy="student")
     *
     */
    public $codification;


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
     * Set ine
     *
     * @param string $ine
     *
     * @return Student
     */
    public function setIne($ine)
    {
        $this->ine = $ine;

        return $this;
    }

    /**
     * Get ine
     *
     * @return string
     */
    public function getIne()
    {
        return $this->ine;
    }

    /**
     * Set cni
     *
     * @param string $cni
     *
     * @return Student
     */
    public function setCni($cni)
    {
        $this->cni = $cni;

        return $this;
    }

    /**
     * Get cni
     *
     * @return string
     */
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Student
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthPlace
     *
     * @param string $birthPlace
     *
     * @return Student
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * Get birthPlace
     *
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return Student
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set optionFormation
     *
     * @param string $optionFormation
     *
     * @return Student
     */
    public function setOptionFormation($optionFormation)
    {
        $this->optionFormation = $optionFormation;

        return $this;
    }

    /**
     * Get optionFormation
     *
     * @return string
     */
    public function getOptionFormation()
    {
        return $this->optionFormation;
    }

    /**
     * Set levelFormation
     *
     * @param string $levelFormation
     *
     * @return Student
     */
    public function setLevelFormation($levelFormation)
    {
        $this->levelFormation = $levelFormation;

        return $this;
    }

    /**
     * Get levelFormation
     *
     * @return string
     */
    public function getLevelFormation()
    {
        return $this->levelFormation;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Student
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return Student
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Student
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set codification.
     *
     * @param \AppBundle\Entity\Codification|null $codification
     *
     * @return Student
     */
    public function setCodification(\AppBundle\Entity\Codification $codification = null)
    {
        $this->codification = $codification;

        return $this;
    }

    /**
     * Get codification.
     *
     * @return \AppBundle\Entity\Codification|null
     */
    public function getCodification()
    {
        return $this->codification;
    }
}
