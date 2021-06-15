<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Note;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $Repairability;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RawMaterial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Country;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     */
    private $Brand;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="favoritesProducts")
     */
    private $users;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->Reference;
    }

    public function setReference(int $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->Note;
    }

    public function setNote(int $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRepairability(): ?int
    {
        return $this->Repairability;
    }

    public function setRepairability(int $Repairability): self
    {
        $this->Repairability = $Repairability;

        return $this;
    }

    public function getRawMaterial(): ?string
    {
        return $this->RawMaterial;
    }

    public function setRawMaterial(string $RawMaterial): self
    {
        $this->RawMaterial = $RawMaterial;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Category->contains($category)) {
            $this->Category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->Category->removeElement($category);

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->Brand;
    }

    public function setBrand(?Brand $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFavoritesProduct($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavoritesProduct($this);
        }

        return $this;
    }
}
