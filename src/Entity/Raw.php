<?php

namespace App\Entity;

use App\Entity\Supplier;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\RawRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: RawRepository::class)]
#[ApiResource(
    operations: [new Post(), new Get(), new Put(), new GetCollection(), new Delete(), new Patch(),
    new GetCollection(name: 'raw_desc', uriTemplate: 'raw/desc', order: ['nommp' => 'DESC']),
    new GetCollection(name: 'raw_asc', uriTemplate: 'raw/asc', order: ['nommp' => 'ASC'])],
    normalizationContext: [
        'groups' =>
            [
                'raw:get',
            ],
    ],
    denormalizationContext: [
        'groups' =>
            [
                'raw:post',
            ],
    ]
    )]
#[ApiFilter(SearchFilter::class, properties: ['user' => 'exact'])]

class Raw
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["raw:get","favorite:get","ingredient:get"])]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["raw:get","raw:post"])]
    private string $nommp;

    #[ORM\Column(type: "string", length: 255)]
    #[Groups(["raw:get","raw:post"])]
    private string $nommpen;

    /**
     * @var Subfamily
     */
    #[ORM\ManyToOne(targetEntity: 'Subfamily')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private Subfamily $refSsfamille;

    /**
     * @var Supplier
     */
    #[ORM\ManyToOne(targetEntity: 'Supplier')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private Supplier $supplier;

    /**
    * @var User
    */
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private User $user;


    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $conv;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $h2o;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $autre1;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $psucre;

    #[ORM\Column(type: "text")]
    #[Groups(["raw:get","raw:post"])]
    private string $caract;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $lmin;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $prixun;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $prixL;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $prixU = 0;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $seuil;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $rupSt;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $dLivJ;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $dLivS;

    #[ORM\Column(type: "text")]
    #[Groups(["raw:get","raw:post"])]
    private string $conditionnement;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $temp;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $humid;

    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $durConsJ = 0;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $durConsS = 0;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?string $majPrix;
    
    #[ORM\Column(type: "text", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?string $cAchat;
    
    #[ORM\Column(type: "text", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?string $cUtil;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $pMaxi;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $cText;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $dAlcool = 0;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $granulo;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $calorie;
    
    #[ORM\Column( type: "text", nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private string $photo;
    
    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $pmg;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $qmg;
    
    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $psuc;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $qsuc;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $simple;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $origine;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $mg;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $sucre;
    
    #[ORM\Column(type: "text", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?string $caracSimple;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?string $dmaj;
    
    #[ORM\Column(type: "float", precision: 10, scale: 0, nullable: false)]
    #[Groups(["raw:get","raw:post"])]
    private float $coutkg;

    #[ORM\Column(type: "text")]
    #[Groups(["raw:get","raw:post"])]
    private string $comutil;

    #[ORM\Column(type: "float", )]
    #[Groups(["raw:get","raw:post"])]
    private float $densite;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $uniteLm;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $unitePa;

    #[ORM\Column(type: "float", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?float $coefDep;

    #[ORM\Column(type: "float", name: "cacao")]
    #[Groups(["raw:get","raw:post"])]
    private float $cacao;

    #[ORM\Column(type: "integer")]
    #[Groups(["raw:get","raw:post"])]
    private int $nombreuniteparkg;

    #[ORM\Column(type: "string" ,length: 255)]
    #[Groups(["raw:get","raw:post"])]
    private string $autreunite;

    #[ORM\Column(type: "datetime")]
    #[Groups(["raw:get","raw:post"])]
    private \DateTime $updated;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $pricebykg;

    #[ORM\Column(type: "integer")]
    #[Groups(["raw:get","raw:post"])]
    private int $formolding = 0;

    #[ORM\Column(type: "integer")]
    #[Groups(["raw:get","raw:post"])]
    private int $canbeduplicated = 1;

    #[ORM\Column(type: "integer")]
    #[Groups(["raw:get","raw:post"])]
    private int $trial = 0;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $qmg2 = 0;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $qmg3 = 0;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $qsuc2 = 0;

    #[ORM\Column(type: "float")]
    #[Groups(["raw:get","raw:post"])]
    private float $qsuc3 = 0;

    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $pmg2;

    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $pmg3;

    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $psuc2;

    #[ORM\Column(type: "integer", nullable: true)]
    #[Groups(["raw:get","raw:post"])]
    private ?int $psuc3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNommp(): ?string
    {
        return $this->nommp;
    }

    public function setNommp(string $nommp): self
    {
        $this->nommp = $nommp;

        return $this;
    }

    public function getNommpen(): ?string
    {
        return $this->nommpen;
    }

    public function setNommpen(string $nommpen): self
    {
        $this->nommpen = $nommpen;

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

    public function getCaract(): ?string
    {
        return $this->caract;
    }

    public function setCaract(string $caract): self
    {
        $this->caract = $caract;

        return $this;
    }

    public function getLmin(): ?float
    {
        return $this->lmin;
    }

    public function setLmin(float $lmin): self
    {
        $this->lmin = $lmin;

        return $this;
    }

    public function getPrixun(): ?float
    {
        return $this->prixun;
    }

    public function setPrixun(float $prixun): self
    {
        $this->prixun = $prixun;

        return $this;
    }

    public function getPrixL(): ?float
    {
        return $this->prixL;
    }

    public function setPrixL(?float $prixL): self
    {
        $this->prixL = $prixL;

        return $this;
    }

    public function getPrixU(): ?float
    {
        return $this->prixU;
    }

    public function setPrixU(?float $prixU): self
    {
        $this->prixU = $prixU;

        return $this;
    }

    public function getSeuil(): ?float
    {
        return $this->seuil;
    }

    public function setSeuil(float $seuil): self
    {
        $this->seuil = $seuil;

        return $this;
    }

    public function getRupSt(): ?float
    {
        return $this->rupSt;
    }

    public function setRupSt(?float $rupSt): self
    {
        $this->rupSt = $rupSt;

        return $this;
    }

    public function getDLivJ(): ?float
    {
        return $this->dLivJ;
    }

    public function setDLivJ(?float $dLivJ): self
    {
        $this->dLivJ = $dLivJ;

        return $this;
    }

    public function getDLivS(): ?float
    {
        return $this->dLivS;
    }

    public function setDLivS(?float $dLivS): self
    {
        $this->dLivS = $dLivS;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getHumid(): ?float
    {
        return $this->humid;
    }

    public function setHumid(float $humid): self
    {
        $this->humid = $humid;

        return $this;
    }

    public function getDurConsJ(): ?float
    {
        return $this->durConsJ;
    }

    public function setDurConsJ(?float $durConsJ): self
    {
        $this->durConsJ = $durConsJ;

        return $this;
    }

    public function getDurConsS(): ?float
    {
        return $this->durConsS;
    }

    public function setDurConsS(?float $durConsS): self
    {
        $this->durConsS = $durConsS;

        return $this;
    }

    public function getMajPrix(): ?string
    {
        return $this->majPrix;
    }

    public function setMajPrix(?string $majPrix): self
    {
        $this->majPrix = $majPrix;

        return $this;
    }

    public function getCAchat(): ?string
    {
        return $this->cAchat;
    }

    public function setCAchat(?string $cAchat): self
    {
        $this->cAchat = $cAchat;

        return $this;
    }

    public function getCUtil(): ?string
    {
        return $this->cUtil;
    }

    public function setCUtil(?string $cUtil): self
    {
        $this->cUtil = $cUtil;

        return $this;
    }

    public function getPMaxi(): ?float
    {
        return $this->pMaxi;
    }

    public function setPMaxi(?float $pMaxi): self
    {
        $this->pMaxi = $pMaxi;

        return $this;
    }

    public function getCText(): ?float
    {
        return $this->cText;
    }

    public function setCText(?float $cText): self
    {
        $this->cText = $cText;

        return $this;
    }

    public function getDAlcool(): ?float
    {
        return $this->dAlcool;
    }

    public function setDAlcool(?float $dAlcool): self
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPmg(): ?int
    {
        return $this->pmg;
    }

    public function setPmg(?int $pmg): self
    {
        $this->pmg = $pmg;

        return $this;
    }

    public function getQmg(): ?float
    {
        return $this->qmg;
    }

    public function setQmg(float $qmg): self
    {
        $this->qmg = $qmg;

        return $this;
    }

    public function getPsuc(): ?int
    {
        return $this->psuc;
    }

    public function setPsuc(?int $psuc): self
    {
        $this->psuc = $psuc;

        return $this;
    }

    public function getQsuc(): ?float
    {
        return $this->qsuc;
    }

    public function setQsuc(float $qsuc): self
    {
        $this->qsuc = $qsuc;

        return $this;
    }

    public function getSimple(): ?float
    {
        return $this->simple;
    }

    public function setSimple(float $simple): self
    {
        $this->simple = $simple;

        return $this;
    }

    public function getOrigine(): ?float
    {
        return $this->origine;
    }

    public function setOrigine(float $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getMg(): ?float
    {
        return $this->mg;
    }

    public function setMg(float $mg): self
    {
        $this->mg = $mg;

        return $this;
    }

    public function getSucre(): ?float
    {
        return $this->sucre;
    }

    public function setSucre(float $sucre): self
    {
        $this->sucre = $sucre;

        return $this;
    }

    public function getCaracSimple(): ?string
    {
        return $this->caracSimple;
    }

    public function setCaracSimple(?string $caracSimple): self
    {
        $this->caracSimple = $caracSimple;

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

    public function getCoutkg(): ?float
    {
        return $this->coutkg;
    }

    public function setCoutkg(float $coutkg): self
    {
        $this->coutkg = $coutkg;

        return $this;
    }

    public function getComutil(): ?string
    {
        return $this->comutil;
    }

    public function setComutil(string $comutil): self
    {
        $this->comutil = $comutil;

        return $this;
    }

    public function getDensite(): ?float
    {
        return $this->densite;
    }

    public function setDensite(float $densite): self
    {
        $this->densite = $densite;

        return $this;
    }

    public function getUniteLm(): ?float
    {
        return $this->uniteLm;
    }

    public function setUniteLm(?float $uniteLm): self
    {
        $this->uniteLm = $uniteLm;

        return $this;
    }

    public function getUnitePa(): ?float
    {
        return $this->unitePa;
    }

    public function setUnitePa(?float $unitePa): self
    {
        $this->unitePa = $unitePa;

        return $this;
    }

    public function getCoefDep(): ?float
    {
        return $this->coefDep;
    }

    public function setCoefDep(?float $coefDep): self
    {
        $this->coefDep = $coefDep;

        return $this;
    }

    public function getCacao(): ?float
    {
        return $this->cacao;
    }

    public function setCacao(float $cacao): self
    {
        $this->cacao = $cacao;

        return $this;
    }

    public function getNombreuniteparkg(): ?int
    {
        return $this->nombreuniteparkg;
    }

    public function setNombreuniteparkg(int $nombreuniteparkg): self
    {
        $this->nombreuniteparkg = $nombreuniteparkg;

        return $this;
    }

    public function getAutreunite(): ?string
    {
        return $this->autreunite;
    }

    public function setAutreunite(string $autreunite): self
    {
        $this->autreunite = $autreunite;

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

    public function getPricebykg(): ?float
    {
        return $this->pricebykg;
    }

    public function setPricebykg(float $pricebykg): self
    {
        $this->pricebykg = $pricebykg;

        return $this;
    }

    public function getFormolding(): ?int
    {
        return $this->formolding;
    }

    public function setFormolding(int $formolding): self
    {
        $this->formolding = $formolding;

        return $this;
    }

    public function getCanbeduplicated(): ?int
    {
        return $this->canbeduplicated;
    }

    public function setCanbeduplicated(int $canbeduplicated): self
    {
        $this->canbeduplicated = $canbeduplicated;

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

    public function getQmg2(): ?float
    {
        return $this->qmg2;
    }

    public function setQmg2(float $qmg2): self
    {
        $this->qmg2 = $qmg2;

        return $this;
    }

    public function getQmg3(): ?float
    {
        return $this->qmg3;
    }

    public function setQmg3(float $qmg3): self
    {
        $this->qmg3 = $qmg3;

        return $this;
    }

    public function getQsuc2(): ?float
    {
        return $this->qsuc2;
    }

    public function setQsuc2(float $qsuc2): self
    {
        $this->qsuc2 = $qsuc2;

        return $this;
    }

    public function getQsuc3(): ?float
    {
        return $this->qsuc3;
    }

    public function setQsuc3(float $qsuc3): self
    {
        $this->qsuc3 = $qsuc3;

        return $this;
    }

    public function getPmg2(): ?int
    {
        return $this->pmg2;
    }

    public function setPmg2(?int $pmg2): self
    {
        $this->pmg2 = $pmg2;

        return $this;
    }

    public function getPmg3(): ?int
    {
        return $this->pmg3;
    }

    public function setPmg3(?int $pmg3): self
    {
        $this->pmg3 = $pmg3;

        return $this;
    }

    public function getPsuc2(): ?int
    {
        return $this->psuc2;
    }

    public function setPsuc2(?int $psuc2): self
    {
        $this->psuc2 = $psuc2;

        return $this;
    }

    public function getPsuc3(): ?int
    {
        return $this->psuc3;
    }

    public function setPsuc3(?int $psuc3): self
    {
        $this->psuc3 = $psuc3;

        return $this;
    }

     /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @param Supplier $supplier
     */
    public function setsupplier(Supplier $supplier): self
    {
        $this->supplier = $supplier;

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
     * Get the value of refSsfamille
     */
    public function getRefSsfamille(): Subfamily
    {
        return $this->refSsfamille;
    }

    /**
     * Set the value of refSsfamille
     */
    public function setRefSsfamille(Subfamily $refSsfamille): self
    {
        $this->refSsfamille = $refSsfamille;

        return $this;
    }
}
