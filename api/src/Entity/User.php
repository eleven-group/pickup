<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Table(name="account")
 * @ORM\Entity
 * @ApiFilter(OrderFilter::class, properties={"id", "username", "email"}, arguments={"orderParameterName"="order"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"read"})
     */
    private $id;
    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;
    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=200, unique=true)
     */
    private $email;
    /**
     * @Groups({"write"})
     * @ORM\Column(type="string", length=500)
     */
    private $password;
    /**
     * @Groups({"read", "write"})
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     */
    private $bio;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\File")
     * @ORM\JoinColumn(nullable=true)
     */
    public $avatar;

    /**
     * @ORM\OneToMany(targetEntity="Absence", mappedBy="owner")
     * @Groups({"read","write"})
     */
    public $absences;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="owner")
     * @Groups({"read","write"})
     */
    public $invoices;

    public function __construct($username)
    {
        $this->isActive = true;
        $this->username = $username;
        $this->absences = new ArrayCollection();
        $this->invoices = new ArrayCollection();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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

    public function getAvatar(): ?File
    {
        return $this->avatar;
    }

    public function setAvatar(?File $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setOwner($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getOwner() === $this) {
                $absence->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setOwner($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->contains($invoice)) {
            $this->invoices->removeElement($invoice);
            // set the owning side to null (unless already changed)
            if ($invoice->getOwner() === $this) {
                $invoice->setOwner(null);
            }
        }

        return $this;
    }
}
