<?php

namespace App\Entity;

use App\Repository\UserExerciseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserExerciseRepository::class)
 */
class UserExercise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Exercise::class, inversedBy="userExercises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exercise;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $repetition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $setTotal;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="exercises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $program;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }


    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(?int $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getSetTotal(): ?int
    {
        return $this->setTotal;
    }

    public function setSetTotal(?int $setTotal): self
    {
        $this->setTotal = $setTotal;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }
}
