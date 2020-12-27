<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * This is the way we can define our custom Arguments to Services as dependencies.
 * Class IsMacArgumentValueResolver
 * @package App\Service
 */
class IsMacArgumentValueResolver implements ArgumentValueResolverInterface
{

    /**
     * @inheritDoc
     */
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getName() === 'isMac';
    }

    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        if ($request->query->has('mac')) {
            yield $request->query->getBoolean('mac');

            return;
        }
        $userAgent = $request->headers->get('User-Agent');

        yield stripos($userAgent, 'Mac') !== false;
    }
}