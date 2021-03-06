<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projekat
 *
 * @ORM\Table(name="projekat", indexes={@ORM\Index(name="idKorisnik_idx", columns={"idKorisnik"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\ProjectRepository")
 */
class Projekat
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProjekat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprojekat;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=45, nullable=false)
     */
    private $ime;

    /**
     * @var int
     *
     * @ORM\Column(name="tip", type="integer", nullable=false)
     */
    private $tip;

    /**
     * @var bool
     *
     * @ORM\Column(name="arhiviran", type="boolean", nullable=false)
     */
    private $arhiviran;

    /**
     * @var \App\Models\Entities\Korisnik
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Korisnik")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idkorisnik", referencedColumnName="idkorisnik")
     * })
     */
    private $idkorisnik;
	   /**
     *
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Sekcija", mappedBy="idprosekcija", orphanRemoval=true)
     */
    private $mySections;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->mySections=new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idprojekat.
     *
     * @return int
     */
    public function getIdprojekat()
    {
        return $this->idprojekat;
    }

    /**
     * Set ime.
     *
     * @param string $ime
     *
     * @return Projekat
     */
    public function setIme($ime)
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * Get ime.
     *
     * @return string
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set tip.
     *
     * @param int $tip
     *
     * @return Projekat
     */
    public function setTip($tip)
    {
        $this->tip = $tip;

        return $this;
    }

    /**
     * Get tip.
     *
     * @return int
     */
    public function getTip()
    {
        return $this->tip;
    }

    /**
     * Set arhiviran.
     *
     * @param bool $arhiviran
     *
     * @return Projekat
     */
    public function setArhiviran($arhiviran)
    {
        $this->arhiviran = $arhiviran;

        return $this;
    }

    /**
     * Get arhiviran.
     *
     * @return bool
     */
    public function getArhiviran()
    {
        return $this->arhiviran;
    }

    /**
     * Set idkorisnik.
     *
     * @param \App\Models\Entities\Korisnik|null $idkorisnik
     *
     * @return Projekat
     */
    public function setIdkorisnik(\App\Models\Entities\Korisnik $idkorisnik = null)
    {
        $this->idkorisnik = $idkorisnik;

        return $this;
    }

    /**
     * Get idkorisnik.
     *
     * @return \App\Models\Entities\Korisnik|null
     */
    public function getIdkorisnik()
    {
        return $this->idkorisnik;
    }
	/**
     * Add mySection.
     *
     * @param \App\Models\Entities\Sekcija $mySection
     *
     * @return Projekat
     */
    public function addMySection(\App\Models\Entities\Sekcija $mySection)
    {
        if(!$this->mySections->contains($mySection)){
            $this->mySections[]=$mySection;
            $mySection->setIdprosekcija($this);
        }
        $this->mySections[] = $mySection;

        return $this;
    }

    /**
     * Remove mySection.
     *
     * @param \App\Models\Entities\Sekcija $mySection
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMySection(\App\Models\Entities\Sekcija $mySection)
    {
        if($this->mySections->contains($mySection)){
            if($mySection->getIdprosekcija()==$this){
                $mySection->setIdprosekcija(null);
            }
        }
        return $this->mySections->removeElement($mySection);
    }

    /**
     * Get mySections.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMySections()
    {
        return $this->mySections;
    }
}
