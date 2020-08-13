<?php

namespace App\Entity;

use App\Repository\ArabaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArabaRepository::class)
 */
class Araba
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Keywords;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Brand;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Gear;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Fue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Modealyear;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="arabas")
     */
    private $Category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getKeywords(): ?string
    {
        return $this->Keywords;
    }

    public function setKeywords(?string $Keywords): self
    {
        $this->Keywords = $Keywords;

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

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(?string $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(?int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(?string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getGear(): ?int
    {
        return $this->Gear;
    }

    public function setGear(?int $Gear): self
    {
        $this->Gear = $Gear;

        return $this;
    }

    public function getFue(): ?string
    {
        return $this->Fue;
    }

    public function setFue(?string $Fue): self
    {
        $this->Fue = $Fue;

        return $this;
    }

    public function getModealyear(): ?int
    {
        return $this->Modealyear;
    }

    public function setModealyear(?int $Modealyear): self
    {
        $this->Modealyear = $Modealyear;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
    public function __toString()
    {
        return (string) $this->name;
    }
}
