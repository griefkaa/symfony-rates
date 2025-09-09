<?php

declare(strict_types=1);

namespace App\ORM;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait UuidIdTrait
{
    /**
     * @var UuidInterface
     */
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: \Ramsey\Uuid\Doctrine\UuidGenerator::class)]
    private $id;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }
}
