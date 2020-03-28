<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait DateTrait
{
    /**
     * @Assert\DateTime
     *
     * @ORM\Column(type="datetime", name="created_at", nullable=true)
     */
    protected $createdAt;

    /**
     * @Assert\DateTime
     *
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    protected $updatedAt;


    /**
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreFlush
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
}
