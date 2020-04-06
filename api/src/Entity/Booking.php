<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\DateTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 *      "shop": "exact",
 *      "status": "exact",
 *      "lastname": "partial"
 * })
 *
 * @UniqueEntity(
 *     fields={"date", "shop", "status"},
 *     errorPath="shop",
 *     message="This slot is already taken."
 * )
 * @ApiFilter(OrderFilter::class,
 *  properties= {"date", "status"}, arguments={"orderParameterName"="order"}
 * )
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
class Booking
{

    use DateTrait;

    const STATUS = ['accepted', 'pending', 'canceled', 'canceled_by_user', 'done'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $content;

    /**
     * @Assert\Choice(choices=Booking::STATUS, message="Choose a valid status.")
     * @ORM\Column(type="string", length=20)
     *
     * @Groups({"read","write"})
     */
    private $status;


    /**
     * @Assert\DateTime
     *
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read","write"})
     */
    protected $date;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"read","write"})
     */
    private $firstname;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"read","write"})
     */
    private $lastname;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=20)
     *
     * @Groups({"read","write"})
     */
    private $phonenumber;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=200)
     *
     * @Groups({"read","write"})
     */
    private $email;

    /**
     * @Groups({"read","write"})
     *
     * @ORM\OneToMany(targetEntity="BookingItem", mappedBy="booking", cascade={"persist"})
     *
     * @MaxDepth(3)
     */
    private $bookingItems;

    /**
     * @Groups({"read","write"})
     *
     * @ORM\ManyToOne(targetEntity="Shop",)
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     *
     * @MaxDepth(2)
     */
    private $shop;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"read","write"})
     */
    private $total;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $token;


    public function __construct()
    {
        $this->bookingItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|BookingItem[]
     */
    public function getBookingItems(): Collection
    {
        return $this->bookingItems;
    }

    public function addBookingItem(BookingItem $bookingItem): self
    {
        if (!$this->bookingItems->contains($bookingItem)) {
            $this->bookingItems[] = $bookingItem;
            $bookingItem->setBooking($this);
        }

        return $this;
    }

    public function removeBookingItem(BookingItem $bookingItem): self
    {
        if ($this->bookingItems->contains($bookingItem)) {
            $this->bookingItems->removeElement($bookingItem);
            // set the owning side to null (unless already changed)
            if ($bookingItem->getBooking() === $this) {
                $bookingItem->setBooking(null);
            }
        }

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTotalFormatted(): ?string
    {
        return ($this->total/100).'€';
    }

    public function getDateFormatted()
    {
        return $this->date->format('l d F Y, H:i');
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateToken(): self
    {
        $this->token = Uuid::uuid4();

        return $this;
    }

}
