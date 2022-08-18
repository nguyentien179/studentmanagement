<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MajorRepository::class)]
class Major
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $MajorName;

    #[ORM\Column(type: 'string', length: 255)]
    private $MajorInfo;

    #[ORM\OneToMany(mappedBy: 'MajorID', targetEntity: Student::class)]
    private $MajorID;

    #[ORM\OneToMany(mappedBy: 'SubjectID', targetEntity: Subject::class)]
    private $SubjectID;

    public function __toString() {
        return $this->MajorName;
    }
    
    public function __construct()
    {
        $this->MajorID = new ArrayCollection();
        $this->SubjectID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajorName(): ?string
    {
        return $this->MajorName;
    }

    public function setMajorName(string $MajorName): self
    {
        $this->MajorName = $MajorName;

        return $this;
    }

    public function getMajorInfo(): ?string
    {
        return $this->MajorInfo;
    }

    public function setMajorInfo(string $MajorInfo): self
    {
        $this->MajorInfo = $MajorInfo;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getMajorID(): Collection
    {
        return $this->MajorID;
    }

    public function addMajorID(Student $majorID): self
    {
        if (!$this->MajorID->contains($majorID)) {
            $this->MajorID[] = $majorID;
            $majorID->setMajorID($this);
        }

        return $this;
    }

    public function removeMajorID(Student $majorID): self
    {
        if ($this->MajorID->removeElement($majorID)) {
            // set the owning side to null (unless already changed)
            if ($majorID->getMajorID() === $this) {
                $majorID->setMajorID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjectID(): Collection
    {
        return $this->SubjectID;
    }

    public function addSubjectID(Subject $subjectID): self
    {
        if (!$this->SubjectID->contains($subjectID)) {
            $this->SubjectID[] = $subjectID;
            $subjectID->setSubjectID($this);
        }

        return $this;
    }

    public function removeSubjectID(Subject $subjectID): self
    {
        if ($this->SubjectID->removeElement($subjectID)) {
            // set the owning side to null (unless already changed)
            if ($subjectID->getSubjectID() === $this) {
                $subjectID->setSubjectID(null);
            }
        }

        return $this;
    }
}
