<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Entity\Traits\DateTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
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
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 * })
 */
class Shop
{

    const TYPE = ['baker', 'butcher', 'pastry', 'other', 'pizza', 'producer', 'burger'];

    use DateTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     */
    private $streetAdress;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     */
    private $postalCode;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="json")
     */
    private $openingHours;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="integer")
     */
    private $slotRange;

    /**
     * @Groups({"read", "write"})
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="shop", cascade={"persist"})
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     *
     * @MaxDepth(1)
     */
    private $owner;

    /**
     *  @Groups({"read", "write"})
     *
     *  @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=500)
     *
     * @Groups({"read","write"})
     */
    private $imageUrl;


    /**
     * @Groups({"read", "write"})
     *
     * @Assert\Choice(choices=Shop::TYPE, message="Choose a valid type.")
     * @ORM\Column(type="string", length=20)
     */
    private $category;

    /**
     * @Groups({"read", "write"})
     * @ORM\OneToMany(targetEntity="Product", mappedBy="shop")
     *
     * @MaxDepth(1)
     */
    private $products;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStreetAdress(): ?string
    {
        return $this->streetAdress;
    }

    public function setStreetAdress(string $streetAdress): self
    {
        $this->streetAdress = $streetAdress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getOpeningHours(): ?array
    {
        return $this->openingHours;
    }

    public function setOpeningHours(array $openingHours): self
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    public function getSlotRange(): ?int
    {
        return $this->slotRange;
    }

    public function setSlotRange(int $slotRange): self
    {
        $this->slotRange = $slotRange;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

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
            $product->setShop($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getShop() === $this) {
                $product->setShop(null);
            }
        }

        return $this;
    }



}
