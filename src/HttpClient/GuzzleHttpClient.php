<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\HttpClient;

use DerrickOb\HostingerApi\Config;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Implementation of the HttpClientInterface using GuzzleHttp.
 */
final class GuzzleHttpClient implements HttpClientInterface
{
    /** @var GuzzleClient The GuzzleHttp client instance. */
    private readonly GuzzleClient $client;

    /**
     * @param Config $config SDK configuration
     */
    public function __construct(Config $config)
    {
        $this->client = new GuzzleClient([
            'base_uri' => $config->getBaseUrl(),
            'timeout' => $config->getTimeout(),
            'headers' => [
                'Authorization' => 'Bearer ' . $config->getApiToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Send a request to the API.
     *
     * @param string               $method  HTTP method (GET, POST, PUT, DELETE)
     * @param string               $uri     URI path
     * @param array<string, mixed> $options Request options
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $contents = $response->getBody()->getContents();

            return json_decode($contents, true) ?? [];
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents(), true) ?? [];
            $message = $responseData['message'] ?? 'An error occurred';
            $correlationId = $responseData['correlation_id'] ?? null;

            match ($statusCode) {
                401 => throw new AuthenticationException($message, $statusCode, $correlationId),
                422 => throw new ValidationException(
                    $message,
                    $statusCode,
                    $correlationId,
                    $responseData['errors'] ?? []
                ),
                429 => throw new RateLimitException($message, $statusCode, $correlationId),
                default => throw new ApiException($message, $statusCode, $correlationId),
            };
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }
}
