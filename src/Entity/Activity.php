<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Company;
use App\Entity\Traits\DatetimeTrait;
use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Activity
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

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "The status cannot be empty")]
    #[Assert\Length(max: 80)]
    private ?string $status = null;

    #[ORM\ManyToMany(targetEntity: Company::class, mappedBy: 'activities')]
    private Collection $companies;
    
    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        $this->companies->removeElement($company);

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
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
