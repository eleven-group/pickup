<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\DateTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingItemRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "booking": "exact",
 * })
 *
 * @ApiResource(
 *   attributes={
 *     "normalization_context"={
 *       "groups"={"read"},
 *       "enable_max_depth"=true
 *     },
 *     "denormalization_context"={"groups"={"write"}},
 *   },
 * )
 */
class BookingItem
{

    use DateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"read"})
     */
    private $id;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="integer")
     *
     * @Groups({"read","write"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="bookingItems")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     *
     * @Groups({"read","write"})
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     *
     *  @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *
     * @Groups({"read","write"})
     *
     * @MaxDepth(3)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

}
