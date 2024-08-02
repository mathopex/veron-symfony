<?php

namespace App\Entity;

use App\Repository\FileRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Post(), 
        new GetCollection(),  
        new Patch(denormalizationContext: ['groups' => ['file:post']]),
        
    ],
    normalizationContext: ['groups' =>['file:get']],
    denormalizationContext: ['groups' =>['file:post']],
)]

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["file:get","file:post"])]
    private int $id;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: false)]
    #[Groups(["file:get","file:post"])]
    private string $name;

    #[ORM\Column(name: "url", type: "string", length: 255, nullable: false)]
    #[Groups(["file:get","file:post"])]
    private string $url;

    #[ORM\Column(name: "remote", type: "string", length: 255, nullable: true)]
    #[Groups(["file:get","file:post"])]
    private string $remote;

    #[ORM\Column(name: "lang", type: "string", length: 255, nullable: false)]
    #[Groups(["file:get","file:post"])]
    private string $lang;

    #[ORM\Column(type: "datetime", nullable: false)]
    #[Groups(["file:get","file:post"])]
    private \DateTime $updated;

     /**
    * @var User
    */
    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["file:get","file:post"])]
    private User $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

   
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

  
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

   
    public function getRemote(): string
    {
        return $this->remote;
    }

    
    public function setRemote(string $remote): self
    {
        $this->remote = $remote;

        return $this;
    }

    
    public function getLang(): string
    {
        return $this->lang;
    }

   
    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

 
    public function setUpdated(\DateTime $updated): self
    {
        $this->updated = $updated;

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
