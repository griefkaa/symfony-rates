<?php

namespace App\Task;

use App\Entity\Rate;
use App\Service\BinanceService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Scheduler\Attribute\AsCronTask;

#[AsCronTask('*/5 * * * *')]
class FetchRatesTask implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const PAIRS = [
        'BTCUSDT' => 'BTC/USDT',
    ];

    public function __construct(
        private readonly BinanceService $binance,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(): void
    {
        foreach (self::PAIRS as $symbol => $pair) {
            $price = $this->binance->getRate($symbol);

            if ($price === null) {
                $this->logger->notice('Price not found for symbol ' . $symbol);

                continue;
            }

            $rate = (new Rate())
                ->setPair($pair)
                ->setPrice((string)$price);

            $this->em->persist($rate);
        }

        $this->em->flush();
    }
}
