<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PayslipRepository")
 *
 * @ApiFilter(SearchFilter::class,
 * properties = {
 *      "owner.id": "exact",
 * })
 */
class Payslip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read","write"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     * @Groups({"read","write"})
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\File")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read","write"})
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
