<?php

declare(strict_types=1);

namespace ORMBundle\Entity\Traits;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAtTrait
{
    /**
     * @var DateTimeInterface
     */
    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    #[ORM\PrePersist]
    public function initializeCreatedAt(): void
    {
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime();
        }
    }
}
