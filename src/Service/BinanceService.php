<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BinanceService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const PRICES_ROUTE = 'api/v3/ticker/price?symbol=%s';

    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly string $baseUrl
    ) {
    }

    public function getRate(string $symbol): ?float
    {
        $url = $this->baseUrl . sprintf(self::PRICES_ROUTE, $symbol);

        try {
            $response = $this->client->request('GET', $url);
            $data = $response->toArray();
            return (float) $data['price'];
        } catch (\Throwable $e) {

            $this->logger->error($e->getMessage());
            return null;
        }
    }
}
