<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ConservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConservationRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), new Patch()],
    normalizationContext: [
        'groups' =>
            [
                'conservation:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'conservation:post',
            ],
    ]
    )]
class Conservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["conservation:get"])]
    private int $id;

    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["conservation:get","conservation:post"])]
    private int $hr;

    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["conservation:get","conservation:post"])]
    private int $hre;

    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["conservation:get","conservation:post"])]
    private int $nbjour;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["conservation:get","conservation:post"])]
    private float $primarykeywd;

    public function getId(): int
    {
        return $this->id;
    }
    public function getHr(): ?int
    {
        return $this->hr;
    }

    public function setHr(int $hr): self
    {
        $this->hr = $hr;

        return $this;
    }

    public function getHre(): ?int
    {
        return $this->hre;
    }

    public function setHre(int $hre): self
    {
        $this->hre = $hre;

        return $this;
    }

    public function getNbjour(): ?int
    {
        return $this->nbjour;
    }

    public function setNbjour(int $nbjour): self
    {
        $this->nbjour = $nbjour;

        return $this;
    }

    public function getPrimarykeywd(): ?float
    {
        return $this->primarykeywd;
    }

    public function setPrimarykeywd(float $primarykeywd): self
    {
        $this->primarykeywd = $primarykeywd;

        return $this;
    }
}
