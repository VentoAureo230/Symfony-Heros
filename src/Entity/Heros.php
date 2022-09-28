<?php

namespace App\Entity;

use App\Repository\HerosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Proxies\__CG__\App\Entity\ClassHeros;

#[ORM\Entity(repositoryClass: HerosRepository::class)]
class Heros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $experience = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $healt_point = null;

    #[ORM\ManyToOne(inversedBy: 'heros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClassHeros $classHeros = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

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

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHealtPoint(): ?int
    {
        return $this->healt_point;
    }

    public function setHealtPoint(int $healt_point): self
    {
        $this->healt_point = $healt_point;

        return $this;
    }

    public function getClassHeros(): ?ClassHeros
    {
        return $this->classHeros;
    }

    //public function __toString(): ?ClassHeros
    //{
    //    return $this->classHeros;
    //}

    public function setClassHeros(?ClassHeros $classHeros): self
    {
        $this->classHeros = $classHeros;

        return $this;
    }
}
