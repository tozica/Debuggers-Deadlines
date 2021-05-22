<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task", indexes={@ORM\Index(name="idkorisnik_idx", columns={"idkorisnik"})})
 * @ORM\Entity
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtask", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtask;

    /**
     * @var string
     *
     * @ORM\Column(name="sadrzaj", type="string", length=45, nullable=false)
     */
    private $sadrzaj;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum;

    /**
     * @var int
     *
     * @ORM\Column(name="prioritet", type="integer", nullable=false)
     */
    private $prioritet;

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
     * Get idtask.
     *
     * @return int
     */
    public function getIdtask()
    {
        return $this->idtask;
    }

    /**
     * Set sadrzaj.
     *
     * @param string $sadrzaj
     *
     * @return Task
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
     * Set datum.
     *
     * @param \DateTime $datum
     *
     * @return Task
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum.
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set prioritet.
     *
     * @param int $prioritet
     *
     * @return Task
     */
    public function setPrioritet($prioritet)
    {
        $this->prioritet = $prioritet;

        return $this;
    }

    /**
     * Get prioritet.
     *
     * @return int
     */
    public function getPrioritet()
    {
        return $this->prioritet;
    }

    /**
     * Set idkorisnik.
     *
     * @param \App\Models\Entities\Korisnik|null $idkorisnik
     *
     * @return Task
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
}
