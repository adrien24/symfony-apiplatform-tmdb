<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MoviesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviesRepository::class)]
#[ApiResource]
class Movies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column]
    private array $production_companies = [];

    #[ORM\Column]
    private array $Genre = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getProductionCompanies(): array
    {
        return $this->production_companies;
        $production_companies[] = 'ROLE_USER';

        return array_unique($production_companies);
    }

    public function setProductionCompanies(array $production_companies): self
    {
        $this->production_companies = $production_companies;

        return $this;
    }

    public function getGenre(): array
    {
        return $this->Genre;
        $Genre[] = 'ROLE_USER';

        return array_unique($Genre);
    }

    public function setGenre(array $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }
}
