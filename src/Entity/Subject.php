<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $SubjectInfo;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'SubjectName')]
    private $courses;

    #[ORM\ManyToOne(targetEntity: Major::class, inversedBy: 'SubjectID')]
    private $SubjectID;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectInfo(): ?string
    {
        return $this->SubjectInfo;
    }

    public function setSubjectInfo(string $SubjectInfo): self
    {
        $this->SubjectInfo = $SubjectInfo;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->addSubjectName($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->removeElement($course)) {
            $course->removeSubjectName($this);
        }

        return $this;
    }

    public function getSubjectID(): ?Major
    {
        return $this->SubjectID;
    }

    public function setSubjectID(?Major $SubjectID): self
    {
        $this->SubjectID = $SubjectID;

        return $this;
    }
}
