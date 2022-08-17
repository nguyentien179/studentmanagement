<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $CourseInfo;

    #[ORM\Column(type: 'float')]
    private $Grade;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'CourseID')]
    private $CourseID;

    #[ORM\ManyToOne(targetEntity: Semester::class, inversedBy: 'CourseName')]
    private $CourseName;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'courses')]
    private $SubjectName;

    public function __construct()
    {
        $this->CourseID = new ArrayCollection();
        $this->SubjectName = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseInfo(): ?string
    {
        return $this->CourseInfo;
    }

    public function setCourseInfo(string $CourseInfo): self
    {
        $this->CourseInfo = $CourseInfo;

        return $this;
    }

    public function getGrade(): ?float
    {
        return $this->Grade;
    }

    public function setGrade(float $Grade): self
    {
        $this->Grade = $Grade;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getCourseID(): Collection
    {
        return $this->CourseID;
    }

    public function addCourseID(Student $courseID): self
    {
        if (!$this->CourseID->contains($courseID)) {
            $this->CourseID[] = $courseID;
        }

        return $this;
    }

    public function removeCourseID(Student $courseID): self
    {
        $this->CourseID->removeElement($courseID);

        return $this;
    }

    public function getCourseName(): ?Semester
    {
        return $this->CourseName;
    }

    public function setCourseName(?Semester $CourseName): self
    {
        $this->CourseName = $CourseName;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjectName(): Collection
    {
        return $this->SubjectName;
    }

    public function addSubjectName(Subject $subjectName): self
    {
        if (!$this->SubjectName->contains($subjectName)) {
            $this->SubjectName[] = $subjectName;
        }

        return $this;
    }

    public function removeSubjectName(Subject $subjectName): self
    {
        $this->SubjectName->removeElement($subjectName);

        return $this;
    }
}
