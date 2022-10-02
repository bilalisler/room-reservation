<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Table(name="reservation")
 * @Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"list"})
     */
    private ?int $id = null;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Payment", cascade={"persist"})
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required payment", groups={"reservation"})
     */
    private ?Payment $payment = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required user", groups={"reservation"})
     */
    private ?User $user = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="reservations")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required rom", groups={"reservation"})
     */
    private ?Room $room = null;

    /**
     * @ORM\Column(type="date", nullable=false)
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required field", groups={"reservation"})
     */
    private ?\DateTimeInterface $startDate = null;

    /**
     * @ORM\Column(type="date", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?\DateTimeInterface $endDate = null;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?int $status = 0;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required guest count", groups={"reservation"})
     * @Assert\GreaterThan(value="0", message="guest count must be greather than 0", groups={"reservation"})
     */
    private ?int $guestCount = null;

    /**
     * @ORM\Column(type="float", nullable=false)
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required price", groups={"reservation"})
     * @Assert\GreaterThan(value="0", message="price must be greather than 0", groups={"reservation"})
     */
    private ?float $price = null;

    /**
     * @ORM\Column(type="float", nullable=false)
     *
     * @Groups({"list"})
     *
     * @Assert\NotBlank(message="required total", groups={"reservation"})
     * @Assert\GreaterThan(value="0", message="total must be greather than 0", groups={"reservation"})
     */
    private ?float $total = null;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Groups({"list"})
     */
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"list"})
     */
    private ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

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
     * @return int|null
     */
    public function getGuestCount(): ?int
    {
        return $this->guestCount;
    }

    /**
     * @param int|null $guestCount
     * @return Reservation
     */
    public function setGuestCount(?int $guestCount): Reservation
    {
        $this->guestCount = $guestCount;
        return $this;
    }

    /**
     * @return Payment|null
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment|null $payment
     * @return Reservation
     */
    public function setPayment(?Payment $payment): Reservation
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return Reservation
     */
    public function setStatus(?int $status): Reservation
    {
        $this->status = $status;
        return $this;
    }
}
