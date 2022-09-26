<?php
namespace App\Request;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SearchRoomRequest
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(message="country should not be empty")
     * Assert\Country()
     */
    private ?string $country = null;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(message="city should not be empty")
     */
    private ?string $city = null;

    /**
     * @Assert\NotBlank(message="start date should not be empty")
     */
    private ?DateTimeInterface $startDate = null;

    /**
     * @Assert\NotBlank(message="end date should not be empty")
     */
    private ?DateTimeInterface $endDate = null;

    /**
     * @var int|null
     *
     * @Assert\NotBlank(message="guest count should not be empty")
     * @Assert\GreaterThan(value="0", message="guest count should be greater than 0")
     */

    private ?int $guestCount = null;

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return SearchRoomRequest
     */
    public function setCountry(?string $country): SearchRoomRequest
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return SearchRoomRequest
     */
    public function setCity(?string $city): SearchRoomRequest
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @param DateTimeInterface|null $startDate
     * @return SearchRoomRequest
     */
    public function setStartDate(?DateTimeInterface $startDate): SearchRoomRequest
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param DateTimeInterface|null $endDate
     * @return SearchRoomRequest
     */
    public function setEndDate(?DateTimeInterface $endDate): SearchRoomRequest
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getGuestCount(): ?int
    {
        return $this->guestCount;
    }

    /**
     * @param int $guestCount
     * @return SearchRoomRequest
     */
    public function setGuestCount(?int $guestCount): SearchRoomRequest
    {
        $this->guestCount = $guestCount;
        return $this;
    }
}
