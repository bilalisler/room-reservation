<?php

namespace App\Entity;

use App\Repository\RoomPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomPropertyRepository::class)]
class RoomProperty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'roomProperties')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $roomProperties;

    public function __construct()
    {
        $this->roomProperties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRoomProperties(): Collection
    {
        return $this->roomProperties;
    }

    public function addRoomProperty(self $roomProperty): self
    {
        if (!$this->roomProperties->contains($roomProperty)) {
            $this->roomProperties->add($roomProperty);
            $roomProperty->setParent($this);
        }

        return $this;
    }

    public function removeRoomProperty(self $roomProperty): self
    {
        if ($this->roomProperties->removeElement($roomProperty)) {
            // set the owning side to null (unless already changed)
            if ($roomProperty->getParent() === $this) {
                $roomProperty->setParent(null);
            }
        }

        return $this;
    }
}
