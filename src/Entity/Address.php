<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Address
 */
#[ORM\Entity]
#[ApiResource(
    operations: [ 
        new Patch(denormalizationContext: ['groups' => ['user:post']]),
        new Get(),
        new GetCollection()
    ],
    normalizationContext: [
        'groups' =>
            [
                'address:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'address:post',
            ],
    ]
    )]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["address:get", "user:post","user:get"])]
    private int $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $civility;

    /**
    * @var User
    */
    #[ORM\OneToOne(inversedBy: 'address',targetEntity: User::class, cascade: ['persist', 'remove'] )]
    #[ORM\JoinColumn(nullable: true, onDelete: "CASCADE")]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private ?User $user = null;

     /**
    * @var Country
    */
    #[ORM\ManyToOne(targetEntity: 'Country')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["user:post", "user:get"])]
    private Country $country;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $firstname;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $name ;

    #[ORM\Column(type: "text", length: 0, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $address;

    #[ORM\Column(type: "text", length: 0, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $street;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $postalcode;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $city;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $state;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $typeaddress;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $telephone;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["address:get","address:post","user:post","user:get"])]
    private string $mobil;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|\App\Entity\User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param null|\App\Entity\User $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalcode(): string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): self
    {
        $this->postalcode = $postalcode;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }

    public function getTypeaddress(): string
    {
        return $this->typeaddress;
    }

    public function setTypeaddress(string $typeaddress): self
    {
        $this->typeaddress = $typeaddress;
        return $this;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getMobil(): string
    {
        return $this->mobil;
    }

    public function setMobil(string $mobil): self
    {
        $this->mobil = $mobil;
        return $this;
    }
}
