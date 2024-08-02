<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource(operations: [new Get(),new GetCollection(),new Patch()],
    normalizationContext: [
        'groups' =>
            [
                'role:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'role:post',
            ],
    ])]
class Role
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(["user:get","role:post",'role:get'])]
    private int $id;

    /**
     * @var string
     */
    #[ORM\Column(name: 'role', type: 'text', length: 255, nullable: false)]
    #[Groups(["user:get","role:post",'role:get'])]
    private string $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
