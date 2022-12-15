<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MemesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemesRepository::class)]
#[ApiResource]
class Memes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column]
    private ?int $width = null;

    #[ORM\Column]
    private ?int $height = null;

    #[ORM\Column]
    private ?int $box_count = null;

    #[ORM\Column]
    private ?int $captions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getBoxCount(): ?int
    {
        return $this->box_count;
    }

    public function setBoxCount(int $box_count): self
    {
        $this->box_count = $box_count;

        return $this;
    }

    public function getCaptions(): ?int
    {
        return $this->captions;
    }

    public function setCaptions(int $captions): self
    {
        $this->captions = $captions;

        return $this;
    }
}
