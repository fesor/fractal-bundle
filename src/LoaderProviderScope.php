<?php

namespace Fesor\FractalBundle;

use League\Fractal\Scope;
use Symfony\Component\DependencyInjection\ServiceLocator;

class LoaderProviderScope extends Scope
{
    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    public function setLoaderServiceLocator(ServiceLocator $locator)
    {
        $this->serviceLocator = $locator;
    }

    public function resolveDataLoader(string $type, bool $allowNull)
    {
        if (!$this->serviceLocator->has($type) && $allowNull) {
            return null;
        }

        return $this->serviceLocator->get($type);
    }
}