<?php

namespace Fesor\FractalBundle\Fractal;

use League\Fractal\ParamBag;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract
{
    private static $includeMethodCache;

    protected function callIncludeMethod(Scope $scope, $includeName, $data)
    {
        $methodName = 'include' . str_replace(' ', '', ucwords(str_replace('_', ' ', str_replace('-', ' ', $includeName))));

        $includeMethod = $this->resolveIncludeMethod($includeName, $methodName);
        $resource = $includeMethod($scope, $data);

        if ($resource === null) {
            return false;
        }

        if (!$resource instanceof ResourceInterface) {
            throw new \Exception(sprintf(
                'Invalid return value from %s::%s(). Expected %s, received %s.',
                __CLASS__,
                $methodName,
                'League\Fractal\Resource\ResourceInterface',
                is_object($resource) ? get_class($resource) : gettype($resource)
            ));
        }

        return $resource;
    }

    private function resolveIncludeMethod(string $includeName, string $methodName)
    {
        if (isset(self::$includeMethodCache[static::class][$methodName])) {
            return self::$includeMethodCache[static::class][$methodName];
        }

        $paramBagProvider = function (Scope $scope) use ($includeName) {
            $scopeIdentifier = $scope->getIdentifier($includeName);

            return $scope->getManager()->getIncludeParams($scopeIdentifier);
        };

        $includeMethodReflection = new \ReflectionMethod($this, $methodName);
        $arguments = $includeMethodReflection->getParameters();
        array_shift($arguments); // skip data argument

        $argumentResolvers = [];

        foreach ($arguments as $argument) {
            $type = $argument->getType();
            $typeNotProvided = !$type;
            $typeIsParamBag = $type && $type->getName() === ParamBag::class;

            if ($typeNotProvided || $typeIsParamBag) {
                $argumentResolvers[] = $paramBagProvider;
                continue;
            }

            $argumentResolvers[] = function (LoaderProviderScope $scope) use ($type) {
                return $scope->resolveDataLoader($type->getName(), $type->allowsNull());
            };
        }

        $includeMethod = function (Scope $scope, $data) use ($methodName, $argumentResolvers) {
            $arguments = [];
            foreach ($argumentResolvers as $resolver) {
                $arguments[] = $resolver($scope);
            }

            return ([$this, $methodName])($data, ...$arguments);
        };

        return self::$includeMethodCache[static::class][$methodName] = $includeMethod;
    }
}
