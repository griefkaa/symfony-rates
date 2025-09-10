<?php

namespace App\ArgumentResolver;

use App\Dto\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidatedDtoResolver implements ValueResolverInterface
{
    public function __construct(private readonly ValidatorInterface $validator) {}

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$this->supports($argument)) {
            return [];
        }

        $dtoClass = $argument->getType();

        //todo: serializer in params
        $dto = new $dtoClass(
            $request->query->get('pair'),
            $request->query->get('date'),
        );

        $errors = $this->validator->validate($dto);

        $this->processErrors($errors);

        yield $dto;
    }

    public function supports(ArgumentMetadata $argument): bool
    {
        return is_a($argument->getType(), RequestInterface::class, true);
    }

    public function processErrors(ConstraintViolationListInterface $errors): void
    {
        if (count($errors) > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }

            throw new BadRequestHttpException(json_encode(['errors' => $messages]));
        }
    }
}
