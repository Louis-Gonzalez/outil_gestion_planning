<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Activity;
use App\Entity\UserInfo;
use App\Entity\Traits\DatetimeTrait;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Company
{
    use DatetimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The name cannot be empty")]
    #[Assert\Length(max: 255)]
    private ?string $name = null;

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
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The city cannot be empty")]
    #[Assert\Length(max: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "The phone cannot be empty")]
    #[Assert\Length(max: 80)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The email cannot be empty")]
    #[Assert\Email]
    #[Assert\Length(max: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Activity::class, inversedBy: 'companies')]
    #[ORM\JoinTable(name: 'company_activity')]
    private Collection $activities;

    #[ORM\ManyToMany(targetEntity: UserInfo::class, inversedBy: 'companies')]
    #[ORM\JoinTable(name: 'user_info_company')]
    private Collection $userInfo;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'companyId')]
    private Collection $reservations;

    public function __construct()
    {
        $this->userInfo = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getUserInfo(): Collection
    {
        return $this->userInfo;
    }

    public function addUserInfo(UserInfo $userInfo): self
    {
        if (!$this->userInfo->contains($userInfo)) {
            $this->userInfo->add($userInfo);
        }
        return $this;
    }

    public function removeUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo->removeElement($userInfo);
        return $this;
    }

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
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getActivities(): \Doctrine\Common\Collections\Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): static
    {
        $this->activities->removeElement($activity);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setCompanyId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getCompanyId() === $this) {
                $reservation->setCompanyId(null);
            }
        }

        return $this;
    }

}
