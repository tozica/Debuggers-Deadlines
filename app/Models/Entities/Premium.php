<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Premium
 *
 * @ORM\Table(name="premium", uniqueConstraints={@ORM\UniqueConstraint(name="brojKartice_UNIQUE", columns={"brojKartice"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\PremiumRepository")
 */
class Premium
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPremium", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPremium;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datumisteka", type="datetime", nullable=false)
     */
    private $datumisteka;

    /**
     * @var int
     *
     * @ORM\Column(name="brojKartice", type="integer", nullable=false)
     */
    private $brojkartice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datumIstekaKartice", type="datetime", nullable=false)
     */
    private $datumistekakartice;

    /**
     * @var int
     *
     * @ORM\Column(name="cvc", type="integer", nullable=false)
     */
    private $cvc;

    /**
     * @var \App\Models\Entities\Korisnik
     *
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Korisnik")
     * @ORM\JoinColumn(name="idkorisnikPremium", referencedColumnName="idkorisnik")
     * })
     */
    private $idkorisnikPremium;

    /**
     * Get idPremium.
     *
     * @return int
     */
    public function getIdpremium()
    {
        return $this->idPremium;
    }

    /**
     * Set datumisteka.
     *
     * @param \DateTime $datumisteka
     *
     * @return Premium
     */
    public function setDatumisteka($datumisteka)
    {
        $this->datumisteka = $datumisteka;

        return $this;
    }

    /**
     * Get datumisteka.
     *
     * @return \DateTime
     */
    public function getDatumisteka()
    {
        return $this->datumisteka;
    }

    /**
     * Set brojkartice.
     *
     * @param int $brojkartice
     *
     * @return Premium
     */
    public function setBrojkartice($brojkartice)
    {
        $this->brojkartice = $brojkartice;

        return $this;
    }

    /**
     * Get brojkartice.
     *
     * @return int
     */
    public function getBrojkartice()
    {
        return $this->brojkartice;
    }

    /**
     * Set datumistekakartice.
     *
     * @param \DateTime $datumistekakartice
     *
     * @return Premium
     */
    public function setDatumistekakartice($datumistekakartice)
    {
        $this->datumistekakartice = $datumistekakartice;

        return $this;
    }

    /**
     * Get datumistekakartice.
     *
     * @return \DateTime
     */
    public function getDatumistekakartice()
    {
        return $this->datumistekakartice;
    }

    /**
     * Set cvc.
     *
     * @param int $cvc
     *
     * @return Premium
     */
    public function setCvc($cvc)
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * Get cvc.
     *
     * @return int
     */
    public function getCvc()
    {
        return $this->cvc;
    }
    
     /**
     * Get idkorisnikPremium.
     *
     * @return \App\Models\Entities\Korisnik|null
     */
    public function getIdkorisnikPremium(){
        return $this->idkorisnikPremium;
    }
    
    
    /**
     * Set idkorisnikPremium.
     *
     * @param \App\Models\Entities\Korisnik|null $idtask
     *
     * @return Alarm
     */
    public function setIdkorisnikPremium($idkorisnikPremium){
        $this->idkorisnikPremium = $idkorisnikPremium;
        return $this;
    }
}
