<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class LastDayRatesRequest
{
    public function __construct(
        #[Assert\NotBlank(message: "Parameter 'pair' is required")]
        #[Assert\Choice(
            choices: ["EUR/BTC", "EUR/ETH", "EUR/LTC", "BTC/USDT"],
            message: "Invalid pair. Allowed values: EUR/BTC, EUR/ETH, EUR/LTC, BTC/USDT"
        )]
        public readonly string $pair,
    ) {}
}
