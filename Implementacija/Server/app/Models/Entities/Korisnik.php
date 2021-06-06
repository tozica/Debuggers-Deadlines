<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Korisnik
 *
 * @ORM\Table(name="korisnik", uniqueConstraints={@ORM\UniqueConstraint(name="korisnickoIme_UNIQUE", columns={"korisnickoIme"}), @ORM\UniqueConstraint(name="mail_UNIQUE", columns={"mail"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\UserRepository")
 */
class Korisnik
{
    /**
     * @var int
     *
     * @ORM\Column(name="idkorisnik", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkorisnik;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=45, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="prezime", type="string", length=45, nullable=false)
     */
    private $prezime;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="korisnickoIme", type="string", length=45, nullable=false)
     */
    private $korisnickoime;

    /**
     * @var string
     *
     * @ORM\Column(name="sifra", type="string", length=45, nullable=false)
     */
    private $sifra;

    /**
     * @var int
     *
     * @ORM\Column(name="tip", type="integer", nullable=false)
     */
    private $tip;
    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Obavestenja", mappedBy="idkorisnik", orphanRemoval=true)
     */
    private $myNotifications;
    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Task", mappedBy="idkorisnik", orphanRemoval=true)
     */
    private $myTasks;
    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Projekat", mappedBy="idkorisnik", orphanRemoval=true)
     */
    private $myProjects;

     /**
     * Constructor
     */
    public function __construct() {
        $this->myNotifications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myProjects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myTasks = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idkorisnik.
     *
     * @return int
     */
    public function getIdkorisnik()
    {
        return $this->idkorisnik;
    }

    /**
     * Set ime.
     *
     * @param string $ime
     *
     * @return Korisnik
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
     * Set prezime.
     *
     * @param string $prezime
     *
     * @return Korisnik
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;

        return $this;
    }

    /**
     * Get prezime.
     *
     * @return string
     */
    public function getPrezime()
    {
        return $this->prezime;
    }

    /**
     * Set mail.
     *
     * @param string $mail
     *
     * @return Korisnik
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set korisnickoime.
     *
     * @param string $korisnickoime
     *
     * @return Korisnik
     */
    public function setKorisnickoime($korisnickoime)
    {
        $this->korisnickoime = $korisnickoime;

        return $this;
    }

    /**
     * Get korisnickoime.
     *
     * @return string
     */
    public function getKorisnickoime()
    {
        return $this->korisnickoime;
    }

    /**
     * Set sifra.
     *
     * @param string $sifra
     *
     * @return Korisnik
     */
    public function setSifra($sifra)
    {
        $this->sifra = $sifra;

        return $this;
    }

    /**
     * Get sifra.
     *
     * @return string
     */
    public function getSifra()
    {
        return $this->sifra;
    }

    /**
     * Set tip.
     *
     * @param int $tip
     *
     * @return Korisnik
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
     * Add myNotification.
     *
     * @param \App\Models\Entities\Obavestenja $myNotification
     *
     * @return Korisnik
     */
    public function addMyNotification(\App\Models\Entities\Obavestenja $myNotification)
    {
        if(!$this->myNotifications->contains($myNotification)){
            $this->myNotifications[] = $myProject;
            $myNotification->setIdkorisnik($this);
        }

        return $this;
    }

    /**
     * Remove myNotification.
     *
     * @param \App\Models\Entities\Obavestenja $myNotification
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMyNotification(\App\Models\Entities\Obavestenja $myNotification)
    {
            if($this->myNotifications->contains($myNotification)){
                if($myNotification->getIdkorisnik() == $this){
                    $myNotification->setIdkorisnik(null);
                }
                return $this->myNotifications->removeElement($myNotification);
        }
        return false;
    }

    /**
     * Get myNotifications.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyNotifications()
    {
        return $this->myNotifications;
    }

    /**
     * Add myTask.
     *
     * @param \App\Models\Entities\Task $myTask
     *
     * @return Korisnik
     */
    public function addMyTask(\App\Models\Entities\Task $myTask)
    {
        if(!$this->myTasks->contains($myTask)){
            $this->myTasks[] = $myTask;
            $myTask->setIdkorisnik($this);
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
                if($myTask->getIdkorisnik() == $this){
                    $myTask->setIdkorisnik(null);
                }
                return $this->myProjects->removeElement($myTask);
        }
        return false;
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

    /**
     * Add myProject.
     *
     * @param \App\Models\Entities\Projekat $myProject
     *
     * @return Korisnik
     */
    public function addMyProject(\App\Models\Entities\Projekat $myProject)
    {   
        if(!$this->myProjects->contains($myProject)){
            $this->myProjects[] = $myProject;
            $myProject->setIdkorisnik($this);
        }

        return $this;
    }

    /**
     * Remove myProject.
     *
     * @param \App\Models\Entities\Projekat $myProject
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMyProject(\App\Models\Entities\Projekat $myProject)
    {
        if($this->myProjects->contains($myProject)){
            if($myProject->getIdkorisnik() == $this){
                $myProject->setIdkorisnik(null);
            }
            return $this->myProjects->removeElement($myProject);
        }
        return false;
    }

    /**
     * Get myProjects.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyProjects()
    {
        return $this->myProjects;
    }
}
