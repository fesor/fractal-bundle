<?php

namespace Fesor\FractalBundle;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;
use League\Fractal\Manager;use Symfony\Component\HttpFoundation\JsonResponse;

class ResourceBuilder
{
    /**
     * @var Manager
     */
    private $fractal;
    /**
     * @var ResourceInterface
     */
    private $resource;

    public function __construct(ResourceInterface $resource)
    {
        $this->fractal = new Manager();
        $this->resource = $resource;
    }

    /**
     * @param TransformerAbstract|callable $transformer
     * @return $this
     */
    public function usingTransformer($transformer)
    {
        $this->resource->setTransformer($transformer);

        return $this;
    }

    /**
     * Specifies list of includes. Useful in case of static import lists.
     *
     * @see includeMatching for more complex cases
     * @param array|string $includes
     * @return $this
     */
    public function including($includes)
    {
        $this->fractal->parseIncludes($includes);

        return $this;
    }

    /**
     * Allows to specify conditional includes. This is very handy in case of complex
     * logic, which should decide what part of response should or should not be exposed
     *
     *  ```
     *  [
     *     'friends' => true, // will be included
     *     'enemies' => false, // will not be included
     *     'balance' => $this->isGranted('VIEW_BALANCE'), // conditional include
     *  ]
     *  ```
     * @param array $includesToMatch contains map of include => decision
     * @return $this
     */
    public function includeMatching(array $includesToMatch)
    {
        $includes = array_keys(array_filter($includesToMatch));
        $this->fractal->parseIncludes($includes);

        return $this;
    }

    /**
     * Exposes result of transformations as `JsonResponse`
     * 
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public function asJsonResponse(int $statusCode = 200, array $headers = []): JsonResponse
    {
        $data = $this->fractal->createData($this->resource);

        return new JsonResponse($data->toArray(), $statusCode, $headers);
    }
}
