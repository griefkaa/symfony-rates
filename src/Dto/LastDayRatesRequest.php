<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class LastDayRatesRequest
{
    public function __construct(
        #[Assert\NotBlank(message: "Parameter 'pair' is required")]
        #[Assert\Choice(
            choices: ["EUR/BTC", "EUR/ETH", "EUR/LTC"],
            message: "Invalid pair. Allowed values: EUR/BTC, EUR/ETH, EUR/LTC"
        )]
        public readonly ?string $pair,
//
//        #[Assert\NotBlank(message: "Parameter 'date' is required")]
//        #[Assert\Date(message: "Parameter 'date' must be in format YYYY-MM-DD")]
//        public readonly ?string $date,
    ) {}
}
