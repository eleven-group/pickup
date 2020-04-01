<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\DateTrait;

/**
 * @ORM\Table(name="account")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
 *
 * @ApiFilter(OrderFilter::class, properties={"id", "username", "email"}, arguments={"orderParameterName"="order"})
 *
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "id": "exact",
 * })
 */
class User implements UserInterface
{
    use DateTrait;
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $username;
    
    /**
     * @Assert\NotBlank
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @Assert\NotBlank
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;
    
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
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups({"read", "write"})
     *
     * @MaxDepth(2)
     * @ORM\OneToOne(targetEntity="Shop", mappedBy="owner")
     */
    public $shop;

    public function __construct()
    {
        $this->isActive = true;
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

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setOwner($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getOwner() === $this) {
                $product->setOwner(null);
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

}
