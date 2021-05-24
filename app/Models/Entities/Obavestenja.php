<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Obavestenja
 *
 * @ORM\Table(name="obavestenja", uniqueConstraints={@ORM\UniqueConstraint(name="idobavestenja_UNIQUE", columns={"idobavestenja"})}, indexes={@ORM\Index(name="idkorisnik_idx", columns={"idkorisnik"})})
 * @ORM\Entity * @ORM\Entity(repositoryClass="App\Models\Repositories\NotificationRepository")
 * 
 */
class Obavestenja
{
    /**
     * @var int
     *
     * @ORM\Column(name="idobavestenja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idobavestenja;

    /**
     * @var string
     *
     * @ORM\Column(name="sadrzaj", type="string", length=45, nullable=false)
     */
    private $sadrzaj;

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
     * @var string
     *
     * @ORM\Column(name="naslov", type="string", length=45, nullable=false)
     */
    private $naslov;



    /**
     * Get idobavestenja.
     *
     * @return int
     */
    public function getIdobavestenja()
    {
        return $this->idobavestenja;
    }

    /**
     * Set sadrzaj.
     *
     * @param string $sadrzaj
     *
     * @return Obavestenja
     */
    public function setSadrzaj($sadrzaj)
    {
        $this->sadrzaj = $sadrzaj;

        return $this;
    }

    /**
     * Get sadrzaj.
     *
     * @return string
     */
    public function getSadrzaj()
    {
        return $this->sadrzaj;
    }

    /**
     * Set idkorisnik.
     *
     * @param \App\Models\Entities\Korisnik|null $idkorisnik
     *
     * @return Obavestenja
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
     * Get naslov.
     *
     * @return string
     */
    public function getNaslov()
    {
        return $this->naslov;
    }
    
     /**
     * Set naslov.
     *
     * @param string $naslov
     *
     * @return Obavestenja
     */
    public function setNaslov($naslov)
    {
        $this->naslov = $naslov;

        return $this;
    }
}
