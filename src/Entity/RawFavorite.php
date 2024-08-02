<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), new Patch()],
    normalizationContext: [
        'groups' =>
            [
                'favorite:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'favorite:post',
            ],
    ]
    )]
#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]
class RawFavorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["favorite:get"])]
    private int $id;

    /**
    * @var User
    */
    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["favorite:get","favorite:post"])]
    private User $user;

    /**
    * @var Raw
    */
    #[ORM\ManyToOne(targetEntity: "Raw")]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["favorite:get","favorite:post"])]
    private Raw $raw;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Raw
     */
    public function getRaw(): Raw
    {
        return $this->raw;
    }

    /**
     * @param Raw $raw
     */
    public function setRaw(Raw $raw): self
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
