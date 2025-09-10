<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\DayRatesRequest;
use App\Dto\LastDayRatesRequest;
use App\Service\RateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RatesController extends AbstractController
{
    public function __construct(
        private readonly RateService $rateService
    ) {
    }

    #[Route('/api/rates/last-24h', name: 'rates_last_24h', methods: ['GET'])]
    public function byLastDay(LastDayRatesRequest $dto): JsonResponse
    {
        return $this->json($this->rateService->getRatesByDay($dto->pair));
    }

    #[Route('/api/rates/day', name: 'api_rates_day', methods: ['GET'])]
    public function byChosenDay(DayRatesRequest $dto,): JsonResponse
    {
        return $this->json($this->rateService->getRatesByDay($dto->pair, $dto->date));
    }
}
