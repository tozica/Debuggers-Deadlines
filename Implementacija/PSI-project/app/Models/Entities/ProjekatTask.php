<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjekatTask
 *
 * @ORM\Table(name="projekat_task", indexes={@ORM\Index(name="idPro_idx", columns={"idProjekat"}), @ORM\Index(name="idTaskPro_idx", columns={"idTaskPro"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\ProjectTaskRepository")
 */
class ProjekatTask
{
    /**
     * @var \App\Models\Entities\Projekat
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Projekat")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idpro", referencedColumnName="idProjekat")
     * })
     */
    private $idpro;

    /**
     * @var \App\Models\Entities\Task
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Task")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idtaskpro", referencedColumnName="idtask")
     * })
     */
    private $idtaskpro;

    /**
     * @var int
     *
     * @ORM\Column(name="idProjekat_task", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprojekatTask;

    /**
     * Get idprojekatTask.
     *
     * @return int
     */
    public function getIdprojekatTask()
    {
        return $this->idprojekatTask;
    }

    /**
     * Set idpro.
     *
     * @param \App\Models\Entities\Projekat|null $idpro
     *
     * @return ProjekatTask
     */
    public function setIdpro(\App\Models\Entities\Projekat $idpro = null)
    {
        $this->idpro = $idpro;

        return $this;
    }

    /**
     * Get idpro.
     *
     * @return \App\Models\Entities\Projekat|null
     */
    public function getIdpro()
    {
        return $this->idpro;
    }

    /**
     * Set idtaskpro.
     *
     * @param \App\Models\Entities\Task|null $idtaskpro
     *
     * @return ProjekatTask
     */
    public function setIdtaskpro(\App\Models\Entities\Task $idtaskpro = null)
    {
        $this->idtaskpro = $idtaskpro;

        return $this;
    }

    /**
     * Get idtaskpro.
     *
     * @return \App\Models\Entities\Task|null
     */
    public function getIdtaskpro()
    {
        return $this->idtaskpro;
    }
}
