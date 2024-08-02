<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\EshreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EshreRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), new Patch()],
    normalizationContext: [
        'groups' =>
            [
                'eshre:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'eshre:post',
            ],
    ]
    )]
class Eshre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["eshre:get"])]
    private int $id;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2, nullable: false)]
    #[Groups(["eshre:get","eshre:post"])]
    private string $es;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2, nullable: false)]
    #[Groups(["eshre:get","eshre:post"])]
    private string $hre;

    public function getId(): int
    {
        return $this->id;
    }
    public function getEs(): ?string
    {
        return $this->es;
    }

    public function setEs(string $es): self
    {
        $this->es = $es;

        return $this;
    }

    public function getHre(): ?string
    {
        return $this->hre;
    }

    public function setHre(string $hre): self
    {
        $this->hre = $hre;

        return $this;
    }
}
