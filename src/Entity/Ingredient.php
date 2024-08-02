<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource(
    operations: [ new Get(),new GetCollection(),new Post(), new Patch(denormalizationContext: ['groups' => ['ingredient:post']])],
    normalizationContext: [
        'groups' =>
            [
                'ingredient:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'ingredient:post',
            ],
    ]
    )]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["ingredient:get"])]
    private int $id;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private float $qte;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private float $prix;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private float $participation;

    #[ORM\Column(type: "boolean", nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private bool $isparticipationfixed = false;

    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private int $deglacage;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private ?float $primarykeywd;

    #[ORM\Column(type: "integer", nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private int $pos;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private float $ingredientpos;

    #[ORM\ManyToOne(targetEntity: "Raw")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private Raw $raw;

    #[ORM\ManyToOne(targetEntity: "Recipe")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["ingredient:get",'ingredient:post'])]
    private Recipe $recipe;


    public function getId(): int
    {
        return $this->id;
    }
    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getParticipation(): ?float
    {
        return $this->participation;
    }

    public function setParticipation(float $participation): self
    {
        $this->participation = $participation;

        return $this;
    }

    public function isIsparticipationfixed(): ?bool
    {
        return $this->isparticipationfixed;
    }

    public function setIsparticipationfixed(bool $isparticipationfixed): self
    {
        $this->isparticipationfixed = $isparticipationfixed;

        return $this;
    }

    public function getDeglacage(): ?int
    {
        return $this->deglacage;
    }

    public function setDeglacage(int $deglacage): self
    {
        $this->deglacage = $deglacage;

        return $this;
    }

    public function getPrimarykeywd(): ?float
    {
        return $this->primarykeywd;
    }

    public function setPrimarykeywd(?float $primarykeywd): self
    {
        $this->primarykeywd = $primarykeywd;

        return $this;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function setPos(int $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    public function getIngredientpos(): ?float
    {
        return $this->ingredientpos;
    }

    public function setIngredientpos(float $ingredientpos): self
    {
        $this->ingredientpos = $ingredientpos;

        return $this;
    }


    /**
     * Get the value of raw
     */
    public function getRaw(): Raw
    {
        return $this->raw;
    }

    /**
     * Set the value of raw
     */
    public function setRaw(Raw $raw): self
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * Get the value of recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    /**
     * Set the value of recipe
     */
    public function setRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
