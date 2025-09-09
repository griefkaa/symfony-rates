<?php

namespace App\Entity;

use App\ORM\UpdatedAtTrait;
use App\ORM\UuidIdTrait;
use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use App\ORM\CreatedAtTrait;

#[ORM\Entity(repositoryClass: RateRepository::class)]
#[ORM\Table(name: 'rate')]
#[ORM\UniqueConstraint(name: 'uniq_pair_updated_at', columns: ['pair', 'updated_at'])]
#[ORM\HasLifecycleCallbacks]
class Rate
{
    use UuidIdTrait;
    use UpdatedAtTrait;
    use CreatedAtTrait;

    #[ORM\Column(type: 'string', length: 16)]
    private string $pair;

    #[ORM\Column(type: 'decimal', precision: 24, scale: 12)]
    private string $price;

    public function getPair(): string
    {
        return $this->pair;
    }
    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPair(string $pair): self
    {
        $this->pair = $pair;

        return $this;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
