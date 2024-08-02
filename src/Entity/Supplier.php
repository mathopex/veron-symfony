<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new GetCollection(), new Delete(), new Patch(denormalizationContext: ['groups' => ['supplier:post']]),
    new GetCollection(name: 'supplier_desc', uriTemplate: 'supplier/desc', order: ['suppliername' => 'DESC']),
    new GetCollection(name: 'supplier_asc', uriTemplate: 'supplier/asc', order: ['suppliername' => 'ASC'])],
    normalizationContext: [
        'groups' =>
            [
                'supplier:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'supplier:post',
            ],
    ]
    )]
#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["supplier:get","raw:get"])]
    private int $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post","raw:get"])]
    private string $suppliername;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $contactname;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $title;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $street;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $locality;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $neighborhood;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $city;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $postalcode;

        /**
    * @var Country
    */
    #[ORM\ManyToOne(targetEntity: 'Country')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private Country $country;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $phone;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $fax;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $email;
    
    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $paymentconditions;
    
    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $remarks;
    
    
    #[ORM\Column(type: "datetime", nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private \DateTime $created;
    
    #[ORM\Column(type: "datetime", nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private \DateTime $updated;
    
    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private string $website;
    
     /**
    * @var User
    */
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private User $user;
    
    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["supplier:get","supplier:post"])]
    private int $trial = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(?int $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getSuppliername(): ?string
    {
        return $this->suppliername;
    }

    public function setSuppliername(string $suppliername): self
    {
        $this->suppliername = $suppliername;

        return $this;
    }

    public function getContactname(): ?string
    {
        return $this->contactname;
    }

    public function setContactname(string $contactname): self
    {
        $this->contactname = $contactname;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(string $neighborhood): self
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

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

    public function getPaymentconditions(): ?string
    {
        return $this->paymentconditions;
    }

    public function setPaymentconditions(string $paymentconditions): self
    {
        $this->paymentconditions = $paymentconditions;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }


    public function getTrial(): ?int
    {
        return $this->trial;
    }

    public function setTrial(int $trial): self
    {
        $this->trial = $trial;

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

    /**
     * Get the value of country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * Set the value of country
     */
    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
