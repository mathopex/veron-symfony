<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource(operations: [new Get(),new GetCollection()])]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["user:get","supplier:get"])]
    private int $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","supplier:get"])]
    private string $nameFrFr;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","supplier:get"])]
    private string $nameEnUs;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","supplier:get"])]
    private string $zone;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","supplier:get"])]
    private string $price;

    #[ORM\Column(type: "boolean", nullable: false)]
    #[Groups(["user:get","supplier:get"])]
    private bool $tvaIntra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFrFr(): ?string
    {
        return $this->nameFrFr;
    }

    public function setNameFrFr(string $nameFrFr): self
    {
        $this->nameFrFr = $nameFrFr;

        return $this;
    }

    public function getNameEnUs(): ?string
    {
        return $this->nameEnUs;
    }

    public function setNameEnUs(string $nameEnUs): self
    {
        $this->nameEnUs = $nameEnUs;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isTvaIntra(): ?bool
    {
        return $this->tvaIntra;
    }

    public function setTvaIntra(bool $tvaIntra): self
    {
        $this->tvaIntra = $tvaIntra;

        return $this;
    }
}
