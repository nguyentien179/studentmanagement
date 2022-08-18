<?php

namespace App\Entity;

use App\Repository\SemesterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemesterRepository::class)]
class Semester
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $SemesterName;

    #[ORM\OneToMany(mappedBy: 'CourseName', targetEntity: Course::class)]
    private $CourseName;

    /**
     * @var string
     *
     * @ORM\Column(name="courseName", type="string", length=255, nullable=false)
     */
    private $nombre;
    public function __toString() {
        return $this->SemesterName;
    }
    public function __construct()
    {
        $this->CourseName = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemesterName(): ?string
    {
        return $this->SemesterName;
    }

    public function setSemesterName(string $SemesterName): self
    {
        $this->SemesterName = $SemesterName;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourseName(): Collection
    {
        return $this->CourseName;
    }

    public function addCourseName(Course $courseName): self
    {
        if (!$this->CourseName->contains($courseName)) {
            $this->CourseName[] = $courseName;
            $courseName->setCourseName($this);
        }

        return $this;
    }

    public function removeCourseName(Course $courseName): self
    {
        if ($this->CourseName->removeElement($courseName)) {
            // set the owning side to null (unless already changed)
            if ($courseName->getCourseName() === $this) {
                $courseName->setCourseName(null);
            }
        }

        return $this;
    }
}
