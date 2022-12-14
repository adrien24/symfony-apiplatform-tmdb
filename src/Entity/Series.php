<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SeriesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeriesRepository::class)]
#[ApiResource]
class Series
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $languages = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $episode_time = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backdrop_path = null;

    #[ORM\Column]
    private ?int $number_episodes = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $origin_country = [];

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(?array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getEpisodeTime(): array
    {
        return $this->episode_time;
    }

    public function setEpisodeTime(?array $episode_time): self
    {
        $this->episode_time = $episode_time;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    public function setBackdropPath(?string $backdrop_path): self
    {
        $this->backdrop_path = $backdrop_path;

        return $this;
    }

    public function getNumberEpisodes(): ?int
    {
        return $this->number_episodes;
    }

    public function setNumberEpisodes(int $number_episodes): self
    {
        $this->number_episodes = $number_episodes;

        return $this;
    }

    public function getOriginCountry(): array
    {
        return $this->origin_country;
    }

    public function setOriginCountry(array $origin_country): self
    {
        $this->origin_country = $origin_country;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
