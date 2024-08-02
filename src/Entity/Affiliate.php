<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AffiliateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffiliateRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), new Patch()],
    normalizationContext: [
        'groups' =>
            [
                'affiliate:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'affiliate:post',
            ],
    ]
    )]
class Affiliate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["affiliate:get"])]
    private int $id;

    #[ORM\Column(type: "datetime")]
    #[Groups(["affiliate:get","affiliate:post"])]
    private \DateTime $created;

    #[ORM\Column(type: "integer")]
    #[Groups(["affiliate:get","affiliate:post"])]
    private int $useridparent = 0;

    #[ORM\Column(type: "integer")]
    #[Groups(["affiliate:get","affiliate:post"])]
    private int $useridchild = 0;

    #[ORM\Column(type: "integer")]
    #[Groups(["affiliate:get","affiliate:post"])]
    private int $isused = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUseridparent(): ?int
    {
        return $this->useridparent;
    }

    public function setUseridparent(int $useridparent): self
    {
        $this->useridparent = $useridparent;

        return $this;
    }

    public function getUseridchild(): ?int
    {
        return $this->useridchild;
    }

    public function setUseridchild(int $useridchild): self
    {
        $this->useridchild = $useridchild;

        return $this;
    }

    public function getIsused(): ?int
    {
        return $this->isused;
    }

    public function setIsused(int $isused): self
    {
        $this->isused = $isused;

        return $this;
    }
}
