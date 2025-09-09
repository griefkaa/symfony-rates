<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\DayRatesRequest;
use App\Dto\LastDayRatesRequest;
use App\Service\RateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatesController extends AbstractController
{
    #[Route('/api/rates/last-24h', name: 'rates_last_24h', methods: ['GET'])]
    public function byLastDay(LastDayRatesRequest $dto, RateService $rateService): JsonResponse
    {
        return $this->json($rateService->getRatesByDay($dto->pair));
    }

    #[Route('/api/rates/day', name: 'api_rates_day', methods: ['GET'])]
    public function byChosenDay(DayRatesRequest $dto, RateService $rateService): JsonResponse
    {
        return $this->json($rateService->getRatesByDay($dto->pair, $dto->date));
    }

    #[Route('/test', name: 'test_nginx')]
    public function index(): Response
    {
        return new Response('<h1>✅ Nginx + Symfony працює!</h1>');
    }
}
