<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $homeType = null;

    #[ORM\Column(length: 50)]
    private ?string $roomType = null;

    #[ORM\Column]
    private ?int $totalCapacity = null;

    #[ORM\Column]
    private ?int $totalBedrooms = null;

    #[ORM\Column]
    private ?int $totalBathrooms = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $hasTv = null;

    #[ORM\Column]
    private ?bool $hasKitchen = null;

    #[ORM\Column]
    private ?bool $hasAirCondition = null;

    #[ORM\Column]
    private ?bool $hasHeating = null;

    #[ORM\Column]
    private ?bool $hasInternet = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomeType(): ?string
    {
        return $this->homeType;
    }

    public function setHomeType(string $homeType): self
    {
        $this->homeType = $homeType;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->roomType;
    }

    public function setRoomType(string $roomType): self
    {
        $this->roomType = $roomType;

        return $this;
    }

    public function getTotalCapacity(): ?int
    {
        return $this->totalCapacity;
    }

    public function setTotalCapacity(int $totalCapacity): self
    {
        $this->totalCapacity = $totalCapacity;

        return $this;
    }

    public function getTotalBedrooms(): ?int
    {
        return $this->totalBedrooms;
    }

    public function setTotalBedrooms(int $totalBedrooms): self
    {
        $this->totalBedrooms = $totalBedrooms;

        return $this;
    }

    public function getTotalBathrooms(): ?int
    {
        return $this->totalBathrooms;
    }

    public function setTotalBathrooms(int $totalBathrooms): self
    {
        $this->totalBathrooms = $totalBathrooms;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function hasTv(): ?bool
    {
        return $this->hasTv;
    }

    public function setHasTv(bool $hasTv): self
    {
        $this->hasTv = $hasTv;

        return $this;
    }

    public function hasKitchen(): ?bool
    {
        return $this->hasKitchen;
    }

    public function setHasKitchen(bool $hasKitchen): self
    {
        $this->hasKitchen = $hasKitchen;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasAirCondition()
    {
        return $this->hasAirCondition;
    }

    /**
     * @param bool|null $hasAirCondition
     * @return Room
     */
    public function setHasAirCondition($hasAirCondition)
    {
        $this->hasAirCondition = $hasAirCondition;
        return $this;
    }

    public function hasHeating(): ?bool
    {
        return $this->hasHeating;
    }

    public function setHasHeating(bool $hasHeating): self
    {
        $this->hasHeating = $hasHeating;

        return $this;
    }

    public function hasInternet(): ?bool
    {
        return $this->hasInternet;
    }

    public function setHasInternet(bool $hasInternet): self
    {
        $this->hasInternet = $hasInternet;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRoom($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getRoom() === $this) {
                $reservation->setRoom(null);
            }
        }

        return $this;
    }
}
