<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ClassName;

    #[ORM\OneToMany(mappedBy: 'ClassID', targetEntity: Student::class)]
    private $ClassID;

    public function __construct()
    {
        $this->ClassID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassName(): ?string
    {
        return $this->ClassName;
    }

    public function setClassName(string $ClassName): self
    {
        $this->ClassName = $ClassName;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getClassID(): Collection
    {
        return $this->ClassID;
    }

    public function addClassID(Student $classID): self
    {
        if (!$this->ClassID->contains($classID)) {
            $this->ClassID[] = $classID;
            $classID->setClassID($this);
        }

        return $this;
    }

    public function removeClassID(Student $classID): self
    {
        if ($this->ClassID->removeElement($classID)) {
            // set the owning side to null (unless already changed)
            if ($classID->getClassID() === $this) {
                $classID->setClassID(null);
            }
        }

        return $this;
    }
}
