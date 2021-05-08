<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labela
 *
 * @ORM\Table(name="labela")
 * @ORM\Entity
 */
class Labela
{
    /**
     * @var int
     *
     * @ORM\Column(name="idlabela", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlabela;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=45, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="bojaTaga", type="string", length=45, nullable=false)
     */
    private $bojataga;



    /**
     * Get idlabela.
     *
     * @return int
     */
    public function getIdlabela()
    {
        return $this->idlabela;
    }

    /**
     * Set ime.
     *
     * @param string $ime
     *
     * @return Labela
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
     * Set bojataga.
     *
     * @param string $bojataga
     *
     * @return Labela
     */
    public function setBojataga($bojataga)
    {
        $this->bojataga = $bojataga;

        return $this;
    }

    /**
     * Get bojataga.
     *
     * @return string
     */
    public function getBojataga()
    {
        return $this->bojataga;
    }
}
