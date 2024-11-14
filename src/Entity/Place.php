<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlaceRepository;
use App\Entity\Traits\DatetimeTrait;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Place
{
    use DatetimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "The name cannot be empty")]
    #[Assert\Length(max: 80)]
    private ?string $name = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "The type cannot be empty")]
    #[Assert\Length(max: 80)]
    private ?string $type = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "The capacity cannot be empty")]
    #[Assert\Range(min: 0,max:500)]
    private ?int $capacity = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The address1 cannot be empty")]
    #[Assert\Length(max: 255)]
    private ?string $address1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $address2 = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank(message: "The zip code cannot be empty")]
    #[Assert\Length(max: 10)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The city cannot be empty")]
    #[Assert\Length(max: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "The phone cannot be empty")]
    #[Assert\Length(max: 80)]
    private ?string $phone = null;

    #[ORM\Column]
    #[Assert\Range(min: 0)]
    private ?int $count = null;

    #[ORM\Column(length: 80)]
    #[Assert\Length(max: 80)]
    #[Assert\NotBlank(message: "The status cannot be empty")]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'places_in_charge')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $personInCharge = null;

    #[ORM\ManyToOne(inversedBy: 'placeId')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): static
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): static
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): static
    {
        $this->count = $count;

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

    public function getPersonInCharge(): ?User
    {
        return $this->personInCharge;
    }

    public function setPersonInCharge(?User $personInCharge): static
    {
        $this->personInCharge = $personInCharge;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
