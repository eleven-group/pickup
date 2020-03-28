<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DateTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbsenceRepository")
 *
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 * })
 */
class Product
{

    const STATUS = ['pending', 'validated', 'refused', 'canceled'];
    const TYPES = ['normal', 'illness', 'free'];

    use DateTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read","write"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read","write"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read","write"})
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read","write"})
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="absences")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

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
}
