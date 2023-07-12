<?php

declare(strict_types=1);

namespace App\Infrastructure\ArgumentResolver;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntityArgumentResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private readonly ManagerRegistry $registry,
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = $argument->getType();

        if (!($type && class_exists($type))) {
            return false;
        }

        if (!$request->attributes->has($argument->getName())) {
            return false;
        }

        return null !== $this->registry->getManagerForClass($type);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $em = $this->registry->getManagerForClass($argument->getType());

        $id = $request->attributes->get($argument->getName());
        if ($id) {
            $entity = $em->find($argument->getType(), $id);
            if (null === $entity) {
                throw new NotFoundHttpException();
            }
            yield $entity;
        } else {
            throw new BadRequestHttpException();
        }
    }
}
