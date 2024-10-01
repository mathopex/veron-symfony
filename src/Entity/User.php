<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\DataProcessor\UserProcessor;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new Post(), 
        new Get(), 
        new Put(), 
        new GetCollection(), 
        new Delete(), 
        new Patch(denormalizationContext: ['groups' => ['user:post']])
    ],
    normalizationContext: ['groups' =>['user:get']],
    denormalizationContext: ['groups' =>['user:post']],
)]
#[ApiResource(processor: UserProcessor::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["user:post"])]
    private ?string $validationToken = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $password = null;

    #[ApiProperty(readableLink: false, writable: true, openapiContext: ["type" => "string", "example" => "password"])]
    #[Groups(["user:post"])]
    private ?string $plainPassword = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(["user:get","user:post"])]
    private ?string $is_verified = 'no';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getRoles(): array
    {
        // Retourne un tableau vide car vous n'utilisez pas de rôles
        return [];
    }

    public function eraseCredentials(): void
    {
        // Si vous avez des données temporaires sensibles sur l'utilisateur, nettoyez-les ici
        $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * Get the value of validationToken
     */
    public function getValidationToken(): ?string
    {
        return $this->validationToken;
    }

    /**
     * Set the value of validationToken
     */
    public function setValidationToken(?string $validationToken): self
    {
        $this->validationToken = $validationToken;

        return $this;
    }   

    /**
     * Get the value of is_verified
     */
    public function getIsVerified(): ?string
    {
        return $this->is_verified;
    }

    /**
     * Set the value of is_verified
     */
    public function setIsVerified(?string $is_verified): self
    {
        $this->is_verified = $is_verified;

        return $this;
    }
}
