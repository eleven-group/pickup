<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 *
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 * })
 */
class Booking
{

    const STATUS = ['accepted', 'pending', 'canceled', 'done'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @Assert\Choice(choices=Booking::STATUS, message="Choose a valid status.")
     * @ORM\Column(type="string", length=20)
     */
    private $status;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="integer", length=10)
     */
    private $phonenumber;

    /**
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", length=200)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="Slot", mappedBy="booking")
     */
    private $slot;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAbsence(): ?Absence
    {
        return $this->absence;
    }

    public function setAbsence(?Absence $absence): self
    {
        $this->absence = $absence;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

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

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getSlot(): ?Slot
    {
        return $this->slot;
    }

    public function setSlot(?Slot $slot): self
    {
        $this->slot = $slot;

        // set (or unset) the owning side of the relation if necessary
        $newBooking = $slot === null ? null : $this;
        if ($newBooking !== $slot->getBooking()) {
            $slot->setBooking($newBooking);
        }

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
}
