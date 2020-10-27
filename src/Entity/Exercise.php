<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciseRepository::class)
 */
class Exercise
{
    private const TYPE_BASE = true;

    private const TYPE_ISOLATED = false;

    private const LEVEL_EASY = 1;

    private const LEVEL_AVG = 2;

    private const LEVEL_HARD = 3;

    private const LEVELS = [
        self::LEVEL_EASY => 'easy',
        self::LEVEL_AVG => 'average',
        self::LEVEL_HARD => 'hard',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="smallint")
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity=Muscle::class, inversedBy="exercises")
     */
    private $muscles;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=UserExercise::class, mappedBy="exercise")
     */
    private $userExercises;

    public function __construct()
    {
        $this->muscles = new ArrayCollection();
        $this->userExercises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Muscle[]
     */
    public function getMuscles(): Collection
    {
        return $this->muscles;
    }

    public function addMuscle(Muscle $muscle): self
    {
        if (!$this->muscles->contains($muscle)) {
            $this->muscles[] = $muscle;
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): self
    {
        if ($this->muscles->contains($muscle)) {
            $this->muscles->removeElement($muscle);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeLabel()
    {
        return $this->type === self::TYPE_BASE ? 'Base' : 'Isolated';
    }

    public function getLevelLabel()
    {
        if (!isset(self::LEVELS[$this->level])) {
            throw new \LogicException("Exercise level {$this->level} unsupported!");
        }
        return self::LEVELS[$this->level];

    }

    /**
     * @return Collection|UserExercise[]
     */
    public function getUserExercises(): Collection
    {
        return $this->userExercises;
    }

    public function addUserExercise(UserExercise $userExercise): self
    {
        if (!$this->userExercises->contains($userExercise)) {
            $this->userExercises[] = $userExercise;
            $userExercise->setExercise($this);
        }

        return $this;
    }

    public function removeUserExercise(UserExercise $userExercise): self
    {
        if ($this->userExercises->contains($userExercise)) {
            $this->userExercises->removeElement($userExercise);
            // set the owning side to null (unless already changed)
            if ($userExercise->getExercise() === $this) {
                $userExercise->setExercise(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
