<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    public function findByDay(string $pair, \DateTimeInterface $date): array
    {
        $qb = $this->createQueryBuilder('r');
        $qb->where('r.pair = :pair')
            ->andWhere('r.createdAt >= :start')
            ->andWhere('r.createdAt < :end')
            ->setParameter('pair', $pair)
            ->setParameter('start', (clone $date)->setTime(0,0,0))
            ->setParameter('end', (clone $date)->modify('+1 day')->setTime(0,0,0))
            ->orderBy('r.createdAt', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
