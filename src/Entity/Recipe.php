<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), 
    new GetCollection(name: 'recipe_desc', uriTemplate: 'recipe/desc', order: ['nom' => 'DESC']),
    new GetCollection(name: 'recipe_asc', uriTemplate: 'recipe/asc', order: ['nom' => 'ASC']),
    new Patch(denormalizationContext: ['groups' => ['recipe:post']])],
    normalizationContext: [
        'groups' =>
            [
                'recipe:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'recipe:post',
            ],
    ]
    )]
#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","ingredient:get"])]
    private int $id;

    #[ORM\Column(name: "nom", type: "string", length: 255, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $nom;

    #[ORM\Column(name: "nomEn", type: "string", length: 255, nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private ?string $nomEn;

    #[ORM\Column(name: "valide", type: "integer", nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private int $valide;
     
    #[ORM\Column(name: "commentaire", type: "text", length: 0, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $commentaire;
     
    #[ORM\Column(name: "dmaj", type: "string", length: 255, nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private ?string $dmaj;

    #[ORM\Column(name: "typeProd", type: "string", length: 255, nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private ?string $typeProd;

    #[ORM\Column(name: "modeOp", type: "text", length: 0, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $modeOp;

    #[ORM\Column(name: "modeOpEn", type: "text", length: 0, nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private ?string $modeOpEn;

    #[ORM\Column(name: "divers", type: "text", length: 0, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $divers;

    #[ORM\Column(name: "poidsBonbon", type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $poidsBonbon;

    #[ORM\Column(name: "poidsTotal", type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $poidsTotal;

    #[ORM\Column(name: "sauv", type: "string", length: 255, nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private $sauv;

    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","recipe:post"])]
    private int $hre;

    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","recipe:post"])]
    private int $tri;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $poidsreel = 0;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $poidsrestant = "";

    #[ORM\Column(type: "datetime")]
    #[Groups(["recipe:get","recipe:post"])]
    private \DateTimeInterface $updated;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $covertype = 0 ;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $unitweightfodder = 0;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $percentagefodder = 0;

    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","recipe:post"])]
    private int $typefodder = 0;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $totalcost = 0;

    #[ORM\Column(type: "float", precision: 10, scale: 0)]
    #[Groups(["recipe:get","recipe:post"])]
    private float $unitcost = 0;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $dluovisee = "";

    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","recipe:post"])]
    private int $rangetemperature = 0;

     /**
    * @var User
    */
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["recipe:get","recipe:post"])]
    private User $user;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $weight2 = "";

    #[ORM\Column(type: "integer")]
    #[Groups(["recipe:get","recipe:post"])]
    private int $trial = 0;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $hrevise = "";

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["recipe:get","recipe:post"])]
    private string $awvise = "";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefProduit(): ?int
    {
        return $this->refProduit;
    }

    public function setRefProduit(?int $refProduit): self
    {
        $this->refProduit = $refProduit;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNomEn(): ?string
    {
        return $this->nomEn;
    }

    public function setNomEn(?string $nomEn): self
    {
        $this->nomEn = $nomEn;

        return $this;
    }

    public function getValide(): ?int
    {
        return $this->valide;
    }

    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDmaj(): ?string
    {
        return $this->dmaj;
    }

    public function setDmaj(?string $dmaj): self
    {
        $this->dmaj = $dmaj;

        return $this;
    }

    public function getOrigin(): ?int
    {
        return $this->origin;
    }

    public function setOrigin(?int $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getTypeProd(): ?string
    {
        return $this->typeProd;
    }

    public function setTypeProd(?string $typeProd): self
    {
        $this->typeProd = $typeProd;

        return $this;
    }

    public function getModeOp(): ?string
    {
        return $this->modeOp;
    }

    public function setModeOp(string $modeOp): self
    {
        $this->modeOp = $modeOp;

        return $this;
    }

    public function getModeOpEn(): ?string
    {
        return $this->modeOpEn;
    }

    public function setModeOpEn(?string $modeOpEn): self
    {
        $this->modeOpEn = $modeOpEn;

        return $this;
    }

    public function getDivers(): ?string
    {
        return $this->divers;
    }

    public function setDivers(string $divers): self
    {
        $this->divers = $divers;

        return $this;
    }

    public function getPoidsBonbon(): ?float
    {
        return $this->poidsBonbon;
    }

    public function setPoidsBonbon(float $poidsBonbon): self
    {
        $this->poidsBonbon = $poidsBonbon;

        return $this;
    }

    public function getPoidsTotal(): ?float
    {
        return $this->poidsTotal;
    }

    public function setPoidsTotal(float $poidsTotal): self
    {
        $this->poidsTotal = $poidsTotal;

        return $this;
    }

    public function getSauv(): ?string
    {
        return $this->sauv;
    }

    public function setSauv(?string $sauv): self
    {
        $this->sauv = $sauv;

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

    public function getTri(): ?int
    {
        return $this->tri;
    }

    public function setTri(int $tri): self
    {
        $this->tri = $tri;

        return $this;
    }

    public function getPoidsreel(): ?float
    {
        return $this->poidsreel;
    }

    public function setPoidsreel(float $poidsreel): self
    {
        $this->poidsreel = $poidsreel;

        return $this;
    }

    public function getPoidsrestant(): ?string
    {
        return $this->poidsrestant;
    }

    public function setPoidsrestant(string $poidsrestant): self
    {
        $this->poidsrestant = $poidsrestant;

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

    public function getCovertype(): ?float
    {
        return $this->covertype;
    }

    public function setCovertype(float $covertype): self
    {
        $this->covertype = $covertype;

        return $this;
    }

    public function getUnitweightfodder(): ?float
    {
        return $this->unitweightfodder;
    }

    public function setUnitweightfodder(float $unitweightfodder): self
    {
        $this->unitweightfodder = $unitweightfodder;

        return $this;
    }

    public function getPercentagefodder(): ?float
    {
        return $this->percentagefodder;
    }

    public function setPercentagefodder(float $percentagefodder): self
    {
        $this->percentagefodder = $percentagefodder;

        return $this;
    }

    public function getTypefodder(): ?int
    {
        return $this->typefodder;
    }

    public function setTypefodder(int $typefodder): self
    {
        $this->typefodder = $typefodder;

        return $this;
    }

    public function getTotalcost(): ?float
    {
        return $this->totalcost;
    }

    public function setTotalcost(float $totalcost): self
    {
        $this->totalcost = $totalcost;

        return $this;
    }

    public function getUnitcost(): ?float
    {
        return $this->unitcost;
    }

    public function setUnitcost(float $unitcost): self
    {
        $this->unitcost = $unitcost;

        return $this;
    }

    public function getDluovisee(): ?string
    {
        return $this->dluovisee;
    }

    public function setDluovisee(string $dluovisee): self
    {
        $this->dluovisee = $dluovisee;

        return $this;
    }

    public function getRangetemperature(): ?int
    {
        return $this->rangetemperature;
    }

    public function setRangetemperature(int $rangetemperature): self
    {
        $this->rangetemperature = $rangetemperature;

        return $this;
    }

    public function getWeight2(): ?string
    {
        return $this->weight2;
    }

    public function setWeight2(string $weight2): self
    {
        $this->weight2 = $weight2;

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

    public function getHrevise(): ?string
    {
        return $this->hrevise;
    }

    public function setHrevise(string $hrevise): self
    {
        $this->hrevise = $hrevise;

        return $this;
    }

    public function getAwvise(): ?string
    {
        return $this->awvise;
    }

    public function setAwvise(string $awvise): self
    {
        $this->awvise = $awvise;

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
