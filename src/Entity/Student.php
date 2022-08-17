<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\ManyToOne(targetEntity: Major::class, inversedBy: 'MajorID')]
    private $MajorID;

    #[ORM\ManyToOne(targetEntity: Classes::class, inversedBy: 'ClassID')]
    private $ClassID;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'CourseID')]
    private $CourseID;

    public function __construct()
    {
        $this->CourseID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMajorID(): ?Major
    {
        return $this->MajorID;
    }

    public function setMajorID(?Major $MajorID): self
    {
        $this->MajorID = $MajorID;

        return $this;
    }

    public function getClassID(): ?Classes
    {
        return $this->ClassID;
    }

    public function setClassID(?Classes $ClassID): self
    {
        $this->ClassID = $ClassID;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourseID(): Collection
    {
        return $this->CourseID;
    }

    public function addCourseID(Course $courseID): self
    {
        if (!$this->CourseID->contains($courseID)) {
            $this->CourseID[] = $courseID;
            $courseID->addCourseID($this);
        }

        return $this;
    }

    public function removeCourseID(Course $courseID): self
    {
        if ($this->CourseID->removeElement($courseID)) {
            $courseID->removeCourseID($this);
        }

        return $this;
    }
}
