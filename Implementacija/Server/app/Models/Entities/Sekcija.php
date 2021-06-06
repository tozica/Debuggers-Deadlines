<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sekcija
 *
 * @ORM\Table(name="sekcija", indexes={@ORM\Index(name="idPro_idx", columns={"idProSekcija"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\SectionRepository")
 */
class Sekcija
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSekcija", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsekcija;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Ime", type="string", length=45, nullable=true)
     */
    private $ime;

    /**
     * @var \App\Models\Entities\Projekat
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Projekat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idprosekcija", referencedColumnName="idProjekat")
     * })
     */
    private $idprosekcija;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Task", mappedBy="idsekcija", orphanRemoval=true)
     */
    private $myTasks;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->myTasks=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idsekcija.
     *
     * @return int
     */
    public function getIdsekcija()
    {
        return $this->idsekcija;
    }

    /**
     * Set ime.
     *
     * @param string|null $ime
     *
     * @return Sekcija
     */
    public function setIme($ime = null)
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * Get ime.
     *
     * @return string|null
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set idprosekcija.
     *
     * @param \App\Models\Entities\Projekat|null $idprosekcija
     *
     * @return Sekcija
     */
    public function setIdprosekcija(\App\Models\Entities\Projekat $idprosekcija = null)
    {
        $this->idprosekcija = $idprosekcija;

        return $this;
    }

    /**
     * Get idprosekcija.
     *
     * @return \App\Models\Entities\Projekat|null
     */
    public function getIdprosekcija()
    {
        return $this->idprosekcija;
    }

    /**
     * Add myTask.
     *
     * @param \App\Models\Entities\Task $myTask
     *
     * @return Sekcija
     */
    public function addMyTask(\App\Models\Entities\Task $myTask)
    {
        if(!$this->myTasks->contains($myTask)){
            
            $this->myTasks[]=$myTask;
            $myTask->setIdsekcija($this);
 
        }
        

        return $this;
    }

    /**
     * Remove myTask.
     *
     * @param \App\Models\Entities\Task $myTask
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMyTask(\App\Models\Entities\Task $myTask)
    {
        if($this->myTasks->contains($myTask)){
            if($myTask->getIdsekcija()==$this){
                $myTask->setIdsekcija(null);
            }
        }
        return $this->myTasks->removeElement($myTask);
    }

    /**
     * Get myTasks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyTasks()
    {
        return $this->myTasks;
    }
}
