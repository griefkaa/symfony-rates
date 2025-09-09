<?php

namespace App\ArgumentResolver;

use App\Dto\DayRatesRequest;
use App\Dto\LastDayRatesRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidatedDtoResolver implements ValueResolverInterface
{
    public function __construct(private readonly ValidatorInterface $validator) {}

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $dtoClass = $argument->getType();

        if (!$dtoClass || !class_exists($dtoClass)) {
            return [];
        }

        if ($dtoClass !== LastDayRatesRequest::class || $dtoClass !== DayRatesRequest::class) {
            return [];
        }

        $dto = new $dtoClass(
            $request->query->get('pair'),
            $request->query->get('date'),
        );

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            throw new BadRequestHttpException(json_encode(['errors' => $messages]));
        }

        return [$dto];
    }
}
