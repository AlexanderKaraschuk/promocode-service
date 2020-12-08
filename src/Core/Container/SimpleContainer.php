<?php

declare(strict_types=1);

namespace App\Core\Container;

use App\Core\Container\Exception\ServiceNotFoundException;
use App\Core\Container\Exception\UnresolvableParameterException;
use Closure;
use ReflectionClass;
use ReflectionNamedType;

final class SimpleContainer implements ContainerInterface
{
    private $services = [];

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException();
        }

        return $this->resolveService($this->services[$id]);
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    public function set(string $abstract, $concrete = null)
    {
        $this->services[$abstract] = $concrete ?? $abstract;
    }

    /**
     * @param string|Closure $concrete
     * @return mixed
     */
    private function resolveService($concrete)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        $concreteReflection = new ReflectionClass($concrete);
        $concreteConstruct = $concreteReflection->getConstructor();

        if (!$concreteConstruct) {
            return $concreteReflection->newInstance();
        }

        $concreteParameters = $concreteConstruct->getParameters();

        if (empty($concreteParameters)) {
            return $concreteReflection->newInstance();
        }

        return $concreteReflection->newInstance(...$this->resolveParameters($concreteParameters));
    }

    /**
     * @param \ReflectionParameter[] $parameters
     */
    private function resolveParameters(array $parameters): array
    {
        $resolvedParameters = [];

        foreach ($parameters as $parameter) {
            $parameterType = $parameter->getType();
            if (!$parameterType || $parameterType->isBuiltin() || !$parameterType instanceof ReflectionNamedType) {
                throw new UnresolvableParameterException();
            }

            $resolvedParameters[] = $this->get($parameterType->getName());
        }

        return $resolvedParameters;
    }
}
