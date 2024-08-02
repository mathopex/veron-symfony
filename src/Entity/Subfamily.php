<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubfamilyRepository;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SubfamilyRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), 
    new GetCollection(name: 'family_asc', uriTemplate: 'family/asc', order: ['nomSSFamille' => 'ASC']), 
    new Delete(), 
    new Patch(denormalizationContext: ['groups' => ['subfamily:post']])],
    normalizationContext: [
        'groups' =>
            [
                'subfamily:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'subfamily:post',
            ],
    ]
    )]
class Subfamily
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["subfamily:get",'raw:get'])]
    private int $id;


    #[ORM\Column(length: 255)]
    #[Groups(["subfamily:get",'subfamily:post','raw:get'])]
    private ?string $famille;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["subfamily:get",'subfamily:post','raw:get'])]
    private ?string $familleEn;

    #[ORM\Column(length: 255)]
    #[Groups(["subfamily:get",'subfamily:post','raw:get'])]
    private ?string $nomSSFamille;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["subfamily:get",'subfamily:post','raw:get'])]
    private ?string $nomSSFamilleEn = null;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $conv;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $h2o;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $autre1;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $psucre;

    #[ORM\Column(length: 255)]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?string $caracteristique = null;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?int $origine;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $cText;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $dAlcool;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $granulo;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?float $calorie;

    #[ORM\Column(length: 255)]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?string $dmaj;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?int $chocolat;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?int $pouvoirSucrant = null;

    #[ORM\Column]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?int $cacaoDegraisse = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["subfamily:get",'subfamily:post'])]
    private ?\DateTimeInterface $updated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getFamilleEn(): ?string
    {
        return $this->familleEn;
    }

    public function setFamilleEn(string $familleEn): self
    {
        $this->familleEn = $familleEn;

        return $this;
    }

    public function getNomSSFamille(): ?string
    {
        return $this->nomSSFamille;
    }

    public function setNomSSFamille(string $nomSSFamille): self
    {
        $this->nomSSFamille = $nomSSFamille;

        return $this;
    }

    public function getNomSSFamilleEn(): ?string
    {
        return $this->nomSSFamilleEn;
    }

    public function setNomSSFamilleEn(?string $nomSSFamilleEn): self
    {
        $this->nomSSFamilleEn = $nomSSFamilleEn;

        return $this;
    }

    public function getConv(): ?float
    {
        return $this->conv;
    }

    public function setConv(float $conv): self
    {
        $this->conv = $conv;

        return $this;
    }

    public function getH2o(): ?float
    {
        return $this->h2o;
    }

    public function setH2o(float $h2o): self
    {
        $this->h2o = $h2o;

        return $this;
    }

    public function getAutre1(): ?float
    {
        return $this->autre1;
    }

    public function setAutre1(float $autre1): self
    {
        $this->autre1 = $autre1;

        return $this;
    }

    public function getPsucre(): ?float
    {
        return $this->psucre;
    }

    public function setPsucre(float $psucre): self
    {
        $this->psucre = $psucre;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function getOrigine(): ?int
    {
        return $this->origine;
    }

    public function setOrigine(int $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getCText(): ?float
    {
        return $this->cText;
    }

    public function setCText(float $cText): self
    {
        $this->cText = $cText;

        return $this;
    }

    public function getDAlcool(): ?float
    {
        return $this->dAlcool;
    }

    public function setDAlcool(float $dAlcool): self
    {
        $this->dAlcool = $dAlcool;

        return $this;
    }

    public function getGranulo(): ?float
    {
        return $this->granulo;
    }

    public function setGranulo(float $granulo): self
    {
        $this->granulo = $granulo;

        return $this;
    }

    public function getCalorie(): ?float
    {
        return $this->calorie;
    }

    public function setCalorie(float $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getDmaj(): ?string
    {
        return $this->dmaj;
    }

    public function setDmaj(string $dmaj): self
    {
        $this->dmaj = $dmaj;

        return $this;
    }

    public function getChocolat(): ?int
    {
        return $this->chocolat;
    }

    public function setChocolat(int $chocolat): self
    {
        $this->chocolat = $chocolat;

        return $this;
    }

    public function getPouvoirSucrant(): ?int
    {
        return $this->pouvoirSucrant;
    }

    public function setPouvoirSucrant(int $pouvoirSucrant): self
    {
        $this->pouvoirSucrant = $pouvoirSucrant;

        return $this;
    }

    public function getCacaoDegraisse(): ?int
    {
        return $this->cacaoDegraisse;
    }

    public function setCacaoDegraisse(int $cacaoDegraisse): self
    {
        $this->cacaoDegraisse = $cacaoDegraisse;

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
}
