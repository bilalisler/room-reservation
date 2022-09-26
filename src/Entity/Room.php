<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @Table(name="room")
 * @Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(type="string",length=50, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $homeType = null;

    /**
     * @ORM\Column(type="string",length=255, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $title = null;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?int $totalCapacity = null;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?int $totalBedrooms = null;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?int $totalBathrooms = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $address = null;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="float", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?float $price = null;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $currency = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $latitude = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $longitude = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="room")
     *
     * @Groups({"list"})
     */
    private Collection $reservations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RoomProperty")
     * @ORM\JoinTable(name="rooms_properties")
     *
     * @Groups({"list"})
     */
    private Collection $roomProperties;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?\DateTimeInterface $updatedAt = null;

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

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRoomProperties()
    {
        return $this->roomProperties;
    }

    /**
     * @param Collection $roomProperties
     * @return Room
     */
    public function setRoomProperties($roomProperties)
    {
        $this->roomProperties = $roomProperties;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return Room
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return Room
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Room
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return Room
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
