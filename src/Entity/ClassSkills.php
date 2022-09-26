<?php

namespace App\Entity;

use App\Repository\ClassSkillsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassSkillsRepository::class)]
class ClassSkills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $skill_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'classSkills')]
    private ?ClassHeros $classHeros = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkillName(): ?string
    {
        return $this->skill_name;
    }

    public function setSkillName(string $skill_name): self
    {
        $this->skill_name = $skill_name;

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

    public function getClassHeros(): ?ClassHeros
    {
        return $this->classHeros;
    }

    public function setClassHeros(?ClassHeros $classHeros): self
    {
        $this->classHeros = $classHeros;

        return $this;
    }
}
