<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alarm
 *
 * @ORM\Table(name="alarm", indexes={@ORM\Index(name="idTask_idx", columns={"idTask"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\AlarmRepository")
 */
class Alarm
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAlarm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalarm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum;

    
    /**
     * @var \App\Models\Entities\Task
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Task")
     * @ORM\JoinColumn(name="idtask", referencedColumnName="idtask")
     */
    private $idtask;



    /**
     * Get idalarm.
     *
     * @return int
     */
    public function getIdalarm()
    {
        return $this->idalarm;
    }

    /**
     * Set datum.
     *
     * @param \DateTime $datum
     *
     * @return Alarm
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
     * Set idtask.
     *
     * @param \App\Models\Entities\Task|null $idtask
     *
     * @return Alarm
     */
    public function setIdtask(\App\Models\Entities\Task $idtask = null)
    {
        $this->idtask = $idtask;

        return $this;
    }

    /**
     * Get idtask.
     *
     * @return \App\Models\Entities\Task|null
     */
    public function getIdtask()
    {
        return $this->idtask;
    }
}
