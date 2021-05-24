<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabelaTask
 *
 * @ORM\Table(name="labela_task", indexes={@ORM\Index(name="idlabela_idx", columns={"idlabela"}), @ORM\Index(name="idTask_idx", columns={"idtaskk"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\LabelTaskRepository")
 */
class LabelaTask
{
    /**
     * @var \App\Models\Entities\Labela
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Labela")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idlabela", referencedColumnName="idlabela")
     * })
     */
    private $idlabela;

    /**
     * @var \App\Models\Entities\Task
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Task")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idtaskk", referencedColumnName="idtask")
     * })
     */
    private $idtaskk;

    /**
     * @var int
     *
     * @ORM\Column(name="idLabela_task", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlabelaTask;

    /**
     * Get idlabelaTask.
     *
     * @return int
     */
    public function getIdlabelaTask()
    {
        return $this->idlabelaTask;
    }

    /**
     * Set idlabela.
     *
     * @param \App\Models\Entities\Labela|null $idlabela
     *
     * @return LabelaTask
     */
    public function setIdlabela(\App\Models\Entities\Labela $idlabela = null)
    {
        $this->idlabela = $idlabela;

        return $this;
    }

    /**
     * Get idlabela.
     *
     * @return \App\Models\Entities\Labela|null
     */
    public function getIdlabela()
    {
        return $this->idlabela;
    }

    /**
     * Set idtaskk.
     *
     * @param \App\Models\Entities\Task|null $idtaskk
     *
     * @return LabelaTask
     */
    public function setIdtaskk(\App\Models\Entities\Task $idtaskk = null)
    {
        $this->idtaskk = $idtaskk;

        return $this;
    }

    /**
     * Get idtaskk.
     *
     * @return \App\Models\Entities\Task|null
     */
    public function getIdtaskk()
    {
        return $this->idtaskk;
    }
}
