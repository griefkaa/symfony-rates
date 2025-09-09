<?php

declare(strict_types=1);

namespace App\ORM;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAtTrait
{
    /**
     * @var DateTimeInterface
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PreUpdate]
    public function refreshUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
