<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Place;
use App\Entity\Company;
use App\Entity\Schedule;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DatetimeTrait;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Reservation
{
    use DatetimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Schedule $scheduleId = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $companyId = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    /**
     * @var Collection<int, Place>
     */
    #[ORM\OneToMany(targetEntity: Place::class, mappedBy: 'reservation')]
    private Collection $placeId;

    #[ORM\Column(length: 80)]
    private ?string $status = null;

    public function __construct()
    {
        $this->placeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScheduleId(): ?Schedule
    {
        return $this->scheduleId;
    }

    public function setScheduleId(?Schedule $scheduleId): static
    {
        $this->scheduleId = $scheduleId;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->companyId;
    }

    public function setCompanyId(?Company $companyId): static
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection<int, Place>
     */
    public function getPlaceId(): Collection
    {
        return $this->placeId;
    }

    public function addPlaceId(Place $placeId): static
    {
        if (!$this->placeId->contains($placeId)) {
            $this->placeId->add($placeId);
            $placeId->setReservation($this);
        }

        return $this;
    }

    public function removePlaceId(Place $placeId): static
    {
        if ($this->placeId->removeElement($placeId)) {
            // set the owning side to null (unless already changed)
            if ($placeId->getReservation() === $this) {
                $placeId->setReservation(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
