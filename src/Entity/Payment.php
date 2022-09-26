<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @Table(name="payment")
 * @Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\Column(type="string", length=16, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $cardNumber = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $cardOwner = null;

    /**
     * @ORM\Column(type="smallint", length=3, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?int $cardCvc = null;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     *
     * @Groups({"list"})
     */
    private ?string $cardExpiry = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCardOwner(): ?string
    {
        return $this->cardOwner;
    }

    public function setCardOwner(string $cardOwner): self
    {
        $this->cardOwner = $cardOwner;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCardCvc(): ?int
    {
        return $this->cardCvc;
    }

    /**
     * @param int|null $cardCvc
     * @return Payment
     */
    public function setCardCvc(?int $cardCvc): Payment
    {
        $this->cardCvc = $cardCvc;

        return $this;
    }

    public function getCardExpiry(): ?string
    {
        return $this->cardExpiry;
    }

    public function setCardExpiry(string $cardExpiry): self
    {
        $this->cardExpiry = $cardExpiry;

        return $this;
    }
}
