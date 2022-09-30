<?php

namespace App\Entity;

use App\Repository\ClassHerosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassHerosRepository::class)]
class ClassHeros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $class_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'classHeros', targetEntity: Heros::class)]
    private Collection $heros;

    #[ORM\OneToMany(mappedBy: 'classHeros', targetEntity: ClassSkills::class)]
    private Collection $classSkills;

    public function __construct()
    {
        $this->heros = new ArrayCollection();
        $this->classSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassName(): ?string
    {
        return $this->class_name;
    }

    public function setClassName(string $class_name): self
    {
        $this->class_name = $class_name;

        return $this;
    }

    public function __toString()
    {  
        return (string) $this->class_name;
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

    /**
     * @return Collection<int, Heros>
     */
    public function getHeros(): Collection
    {
        return $this->heros;
    }

    public function addHero(Heros $hero): self
    {
        if (!$this->heros->contains($hero)) {
            $this->heros->add($hero);
            $hero->setClassHeros($this);
        }

        return $this;
    }

    public function removeHero(Heros $hero): self
    {
        if ($this->heros->removeElement($hero)) {
            // set the owning side to null (unless already changed)
            if ($hero->getClassHeros() === $this) {
                $hero->setClassHeros(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ClassSkills>
     */
    public function getClassSkills(): Collection
    {
        return $this->classSkills;
    }

    public function addClassSkill(ClassSkills $classSkill): self
    {
        if (!$this->classSkills->contains($classSkill)) {
            $this->classSkills->add($classSkill);
            $classSkill->setClassHeros($this);
        }

        return $this;
    }

    public function removeClassSkill(ClassSkills $classSkill): self
    {
        if ($this->classSkills->removeElement($classSkill)) {
            // set the owning side to null (unless already changed)
            if ($classSkill->getClassHeros() === $this) {
                $classSkill->setClassHeros(null);
            }
        }

        return $this;
    }
}
