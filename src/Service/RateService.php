<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\RateRepository;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class RateService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(
        private readonly RateRepository $rateRepository,
        private readonly CacheInterface $cache,
    ){
    }

    public function getRatesByDay(string $pair, ?string $date = null): array
    {
        try {
            $date = new \DateTimeImmutable();

            $cacheKey = sprintf("rates_day_%s_%s", str_replace('/', '_', $pair), $date->format('Y-m-d'));

            return $this->cache->get($cacheKey, function (ItemInterface $item) use ($pair, $date) {
                $item->expiresAfter(300);

                $rates = $this->rateRepository->findByDay($pair, $date);

                return array_map(fn($rate) => [
                    'pair'  => $rate->getPair(),
                    'price' => $rate->getPrice(),
                    'time'  => $rate->getCreatedAt()->format('Y-m-d H:i:s'),
                ], $rates);
            });
        } catch (\Throwable $exception) {
            $this->logger->error('Something went wrong while getting rates', ['exception' => $exception]);

            return [
                'pair' => '',
                'price' => '100',
                'time'  => (new \DateTime())->format('Y-m-d H:i:s'),
                'rates' => []
            ];
        }
    }
}
