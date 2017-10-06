<?php

namespace Fesor\FractalBundle;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\ScopeFactory;
use League\Fractal\ScopeFactoryInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

class LoaderProviderScopeFactory extends ScopeFactory
{
    /**
     * @var ScopeFactoryInterface
     */
    private $original;
    /**
     * @var ServiceLocator
     */
    private $locator;

    public function __construct(ScopeFactoryInterface $original, ServiceLocator $locator)
    {
        $this->original = $original;
        $this->locator = $locator;
    }

    /**
     * @param Manager $manager
     * @param ResourceInterface $resource
     * @param string|null $scopeIdentifier
     * @return LoaderProviderScope
     */
    public function createScopeFor(Manager $manager, ResourceInterface $resource, $scopeIdentifier = null)
    {
        $scope = new LoaderProviderScope($manager, $resource, $scopeIdentifier);
        $scope->setLoaderServiceLocator($this->locator);

        return $scope;
    }
}