<?php

namespace App\Entity;

use App\Repository\RoomPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @Table(name="room_property")
 * @Entity(repositoryClass="App\Repository\RoomPropertyRepository")
 */
class RoomProperty
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"list"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $name = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RoomProperty", inversedBy="roomProperties")
     * @ORM\JoinColumn(name="parent_id",referencedColumnName="id")
     *
     * @Groups({"list"})
     */
    private ?self $parent = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RoomProperty", mappedBy="parent")
     */
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
