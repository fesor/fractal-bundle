<?php

namespace Tests\Fesor\FractalBundle\Functional;

use Lakion\ApiTestCase\JsonApiTestCase;

class IncludesParsingTest extends JsonApiTestCase
{
    /**
     * @dataProvider includesProvider
     * @param string $path
     * @param mixed $expectedValue
     * @param string $includeParam
     */
    public function testExample(string $path, $expectedValue, string $includeParam)
    {
        $this->client->request('GET', '/tests/includes?include=' . $includeParam);

        $response = $this->client->getResponse();
        $this->assertResponseCode($response, 200);
        $this->assertJsonStringEqualsJsonString(json_encode([
            'data' => [$path => $expectedValue]
        ]), $response->getContent());
    }

    public function includesProvider()
    {
        return [
            ['snake_case', 1, 'snake_case'],
            ['with-dash', 2, 'with-dash'],
            ['with space', 10, 'with%20space:limit(10)'],
            ['with-multiple-param-bags', [10, 20], 'with-multiple-param-bags:limit(10):offset(20)'],
        ];
    }
}
