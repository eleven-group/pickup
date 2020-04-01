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

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 * })
 */
class Booking
{

    use DateTrait;

    const STATUS = ['accepted', 'pending', 'canceled', 'done'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"read","write"})
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
     * @ORM\Column(type="integer", length=10)
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
     * @ORM\OneToMany(targetEntity="BookingItem", mappedBy="booking")
     *
     * @Groups({"read","write"})
     */
    private $bookingItems;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     *
     * @Groups({"read","write"})
     */
    private $client;

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

    public function getPhonenumber(): ?int
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(int $phonenumber): self
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

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

}
