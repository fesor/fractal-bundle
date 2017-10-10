<?php

namespace Tests\Fesor\FractalBundle\Functional\Example;

use Fesor\FractalBundle\FractalBundle;
use PSS\SymfonyMockerContainer\DependencyInjection\MockerContainer;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Tests\Fesor\FractalBundle\Functional\Example\Controller\BookController;
use Tests\Fesor\FractalBundle\Functional\Example\Controller\TestController;

class AppKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new FractalBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->add('/tests/includes', TestController::class . ':differentIncludes', 'different_includes');
        $routes->add('/books/{id}', BookController::class . ':getBookDetails', 'book_details');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', [
            'secret' => 'let me tell you a secret',
            'test' => true,
        ]);

        $c->register(TestController::class)->setAutowired(true);
        $c->register(BookController::class)->setAutowired(true);
    }

    /**
     * @todo get rid of this dependency
     * @return string
     */
    protected function getContainerBaseClass()
    {
        return MockerContainer::class;
    }

    public function getCacheDir()
    {
        return __DIR__ . '/../../../var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return __DIR__ . '/../../../var/logs';
    }
}