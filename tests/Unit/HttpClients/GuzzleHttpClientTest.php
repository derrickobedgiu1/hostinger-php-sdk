<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\HttpClient;

use DerrickOb\HostingerApi\Config;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\HttpClient\GuzzleHttpClient;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Mockery\MockInterface;
use ReflectionClass;

function mockGuzzleClient(): GuzzleClient|MockInterface
{
    /** @var GuzzleClient&MockInterface $mock */
    $mock = Mockery::mock(GuzzleClient::class);

    return $mock;
}

test('constructor initializes guzzle client when none provided', function (): void {
    $config = new Config('test-token');
    $httpClient = new GuzzleHttpClient($config);

    $reflection = new ReflectionClass(GuzzleHttpClient::class);
    $clientProperty = $reflection->getProperty('client');
    $clientProperty->setAccessible(true);

    expect($clientProperty->getValue($httpClient))->toBeInstanceOf(GuzzleClient::class);
});

test('constructor uses provided guzzle client', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $reflection = new ReflectionClass(GuzzleHttpClient::class);
    $clientProperty = $reflection->getProperty('client');
    $clientProperty->setAccessible(true);

    expect($clientProperty->getValue($httpClient))->toBe($mockGuzzle);
});

test('request performs successful GET', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $expectedResponse = ['success' => true, 'data' => ['id' => 1]];
    $mockPsrResponse = new Response(200, [], (string) json_encode($expectedResponse));

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', ['query' => ['param' => 'value']])
        ->once()
        ->andReturn($mockPsrResponse);

    $response = $httpClient->request('GET', 'test/path', ['query' => ['param' => 'value']]);

    expect($response)->toBe($expectedResponse);
});

test('request performs successful POST', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $requestData = ['name' => 'test'];
    $expectedResponse = ['id' => 123, 'name' => 'test'];
    $mockPsrResponse = new Response(201, [], (string) json_encode($expectedResponse));

    $mockGuzzle->shouldReceive('request')
        ->with('POST', 'test/path', ['json' => $requestData])
        ->once()
        ->andReturn($mockPsrResponse);

    $response = $httpClient->request('POST', 'test/path', ['json' => $requestData]);

    expect($response)->toBe($expectedResponse);
});

test('request throws AuthenticationException on 401', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $responseBody = (string) json_encode(['message' => 'Unauthenticated.', 'correlation_id' => 'corr-id-401']);
    $mockPsrResponse = new Response(401, [], $responseBody);
    $exception = new ClientException('Client Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    $httpClient->request('GET', 'test/path');
})->throws(AuthenticationException::class, 'Unauthenticated.');

test('request throws ValidationException on 422', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('POST', 'test/path');
    $errors = ['field' => ['The field is required.']];
    $responseBody = (string) json_encode(['message' => 'Validation Failed', 'errors' => $errors, 'correlation_id' => 'corr-id-422']);
    $mockPsrResponse = new Response(422, [], $responseBody);
    $exception = new ClientException('Client Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('POST', 'test/path', [])
        ->once()
        ->andThrow($exception);

    try {
        $httpClient->request('POST', 'test/path');
    } catch (ValidationException $validationException) {
        expect($validationException->getMessage())->toBe('Validation Failed')
            ->and($validationException->getErrors())->toBe($errors)
            ->and($validationException->getCorrelationId())->toBe('corr-id-422');

        return;
    }

    throw new Exception('ValidationException was not thrown.');
});

test('request throws RateLimitException on 429', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $responseBody = (string) json_encode(['message' => 'Too Many Requests', 'correlation_id' => 'corr-id-429']);
    $mockPsrResponse = new Response(429, [], $responseBody);
    $exception = new ClientException('Client Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    $httpClient->request('GET', 'test/path');
})->throws(RateLimitException::class, 'Too Many Requests');

test('request throws ApiException on other 4xx/5xx', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $responseBody = (string) json_encode(['message' => 'Server Error', 'correlation_id' => 'corr-id-500']);
    $mockPsrResponse = new Response(500, [], $responseBody);
    $exception = new ClientException('Server Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    $httpClient->request('GET', 'test/path');
})->throws(ApiException::class, 'Server Error');

test('request throws ApiException on general GuzzleException', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $exception = new ConnectException('Connection refused', $request);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    $httpClient->request('GET', 'test/path');
})->throws(ApiException::class, 'Connection refused');

test('request handles empty response body', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $mockPsrResponse = new Response(200, [], '');

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andReturn($mockPsrResponse);

    $response = $httpClient->request('GET', 'test/path');

    expect($response)->toBe([]);
});

test('request handles non-json response body gracefully', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $mockPsrResponse = new Response(200, [], 'Not JSON');

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andReturn($mockPsrResponse);

    $response = $httpClient->request('GET', 'test/path');

    expect($response)->toBe([]);
});

test('request handles error response with non-json body', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $mockPsrResponse = new Response(500, [], 'Internal Server Error Text');
    $exception = new ClientException('Server Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    $httpClient->request('GET', 'test/path');
})->throws(ApiException::class, 'An error occurred');

test('request handles error response with missing message/correlation_id', function (): void {
    $config = new Config('test-token');

    /** @var GuzzleClient&MockInterface $mockGuzzle */
    $mockGuzzle = mockGuzzleClient();
    $httpClient = new GuzzleHttpClient($config, $mockGuzzle);

    $request = new Request('GET', 'test/path');
    $responseBody = (string) json_encode(['some_other_key' => 'value']);
    $mockPsrResponse = new Response(400, [], $responseBody);
    $exception = new ClientException('Client Error', $request, $mockPsrResponse);

    $mockGuzzle->shouldReceive('request')
        ->with('GET', 'test/path', [])
        ->once()
        ->andThrow($exception);

    try {
        $httpClient->request('GET', 'test/path');
    } catch (ApiException $apiException) {
        expect($apiException->getMessage())->toBe('An error occurred')
        ->and($apiException->getCorrelationId())->toBeNull();

        return;
    }

    throw new Exception('ApiException was not thrown.');
});
