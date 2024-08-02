<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\DataProcessor\UserProcessor;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * User
 */
#[ORM\Entity]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new Post(processor: UserProcessor::class), 
        new Get(), 
        new Put(), 
        new GetCollection(), 
        new Delete(), 
        new Patch(denormalizationContext: ['groups' => ['user:post']]),
        new GetCollection(name: 'user_desc', uriTemplate: 'user/desc', order: ['login' => 'DESC']),
        new GetCollection(name: 'user_asc', uriTemplate: 'user/asc', order: ['login' => 'ASC'])],
    normalizationContext: ['groups' =>['user:get']],
    denormalizationContext: ['groups' =>['user:post']],
    
    
    )]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
    * @var int
    */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user:get","supplier:get","raw:get","recipe:get","favorite:get","category:get"])]
    private int $id;

      /**
    * @var string
    */
    #[ORM\Column(name: "login", type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","user:post","category:get"])]
    private string $login;


    #[ORM\Column(name: "password", type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private string $password;
 
    #[ApiProperty(readableLink: false, writable: true, openapiContext: ["type" => "string", "example" => "password"])]
    #[Groups(["user:post"])]
    private ?string $plainPassword = null;

    #[ORM\Column(name: "email", type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private string $email;

    /**
    * @var Role
    */
    #[ORM\ManyToOne(targetEntity: 'Role')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["user:post", "user:get"])]
    private Role $role;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private string $language;

    #[ORM\Column(type: "string", length: 20, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private string $currency;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private string $license;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["user:get","user:post"])]
    private float $hre;

    /**
    * @var Address
    */
    #[ORM\OneToOne(mappedBy: 'user',targetEntity: Address::class, cascade: ['persist', 'remove'] )]
    #[Groups(["user:post", "user:get"])]
    private Address $address;


    #[ORM\Column(type: "string", length: 150, nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?string $region;

    #[ORM\Column(type: "datetime", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?\DateTime $updated = null;

    #[ORM\Column(type: "datetime", nullable: false)]
    #[Groups(["user:get","user:post"])]
    private \DateTime $created;

    #[ORM\Column(type: "datetime", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?\DateTime $startAbonnement = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?\DateTime $endAbonnement = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?\DateTime $blockedDate = null;
 
 
    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?int $abonementDuration = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?string $duration = null;


    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?int $cronemail = 0;

    #[ORM\Column(type: "string", nullable: true)]
    #[Groups(["user:get","user:post"])]
    private ?string $societyname;
   


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        if ($address->getUser() !== $this) {
            $address->setUser($this);
        }
        $this->address = $address;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getHre(): ?float
    {
        return $this->hre;
    }

    public function setHre(float $hre): self
    {
        $this->hre = $hre;

        return $this;
    }


    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }


    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }


    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCronemail(): ?int
    {
        return $this->cronemail;
    }

    public function setCronemail(?int $cronemail): self
    {
        $this->cronemail = $cronemail;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->getRole()->getRole()];
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
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


    public function getSocietyname(): ?string
    {
        return $this->societyname;
    }


    public function setSocietyname(?string $societyname): self
    {
        $this->societyname = $societyname;

        return $this;
    }

   
    public function getCreated(): \DateTimeInterface
    {
        return $this->created;
    }

    
    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    
    public function getEndAbonnement(): ?\DateTimeInterface
    {
        return $this->endAbonnement;
    }

   
    public function setEndAbonnement(?\DateTimeInterface $endAbonnement): self
    {
        $this->endAbonnement = $endAbonnement;

        return $this;
    }

    
    public function getStartAbonnement(): ?\DateTimeInterface
    {
        return $this->startAbonnement;
    }

 
    public function setStartAbonnement(?\DateTimeInterface $startAbonnement): self
    {
        $this->startAbonnement = $startAbonnement;

        return $this;
    }

  
    public function getBlockedDate(): ?\DateTimeInterface
    {
        return $this->blockedDate;
    }

   
    public function setBlockedDate(?\DateTimeInterface $blockedDate): self
    {
        $this->blockedDate = $blockedDate;

        return $this;
    }

   
    public function getAbonementDuration(): ?int
    {
        return $this->abonementDuration;
    }

  
    public function setAbonementDuration(?int $abonementDuration): self
    {
        $this->abonementDuration = $abonementDuration;

        return $this;
    }
}