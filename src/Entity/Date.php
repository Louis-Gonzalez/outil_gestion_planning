<?php

namespace App\Entity;

use App\Entity\Day;
use App\Entity\WeekNbr;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DateRepository;
use App\Entity\Traits\DatetimeTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DateRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Date
{
    use DatetimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: "The date cannot be empty")]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'date', targetEntity: Schedule::class)]
    private Collection $schedules;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
    }

    #[ORM\ManyToOne(inversedBy: 'dates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Day $dayId = null;

    #[ORM\ManyToOne(inversedBy: 'dates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WeekNbr $weekId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getDayId(): ?Day
    {
        return $this->dayId;
    }

    public function setDayId(?Day $dayId): static
    {
        $this->dayId = $dayId;
        return $this;
    }

    public function getWeekId(): ?WeekNbr
    {
        return $this->weekId;
    }

    public function setWeekId(?WeekNbr $weekId): static
    {
        $this->weekId = $weekId;
        return $this;
    }
}
