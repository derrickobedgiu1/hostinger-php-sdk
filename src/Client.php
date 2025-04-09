<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\HttpClient\GuzzleHttpClient;
use DerrickOb\HostingerApi\HttpClient\HttpClientInterface;

/**
 * Client for making API requests to the Hostinger API.
 */
final class Client implements ClientInterface
{
    /** @var HttpClientInterface The HTTP client instance. */
    private readonly HttpClientInterface $httpClient;

    /**
     * Create a new client instance.
     *
     * @param Config                   $config     The configuration
     * @param HttpClientInterface|null $httpClient Optional custom HTTP client
     */
    public function __construct(private readonly Config $config, ?HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new GuzzleHttpClient($this->config);
    }

    /**
     * Send a GET request.
     *
     * @param string               $path  API endpoint path
     * @param array<string, mixed> $query Optional query parameters
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function get(string $path, array $query = []): array
    {
        $options = $query === [] ? [] : ['query' => $query];

        return $this->httpClient->request('GET', $path, $options);
    }

    /**
     * Send a POST request.
     *
     * @param string               $path API endpoint path
     * @param array<string, mixed> $data Request data
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function post(string $path, array $data = []): array
    {
        return $this->httpClient->request('POST', $path, ['json' => $data]);
    }

    /**
     * Send a PUT request.
     *
     * @param string               $path API endpoint path
     * @param array<string, mixed> $data Request data
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function put(string $path, array $data = []): array
    {
        return $this->httpClient->request('PUT', $path, ['json' => $data]);
    }

    /**
     * Send a DELETE request.
     *
     * @param string               $path API endpoint path
     * @param array<string, mixed> $data Optional request data
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function delete(string $path, array $data = []): array
    {
        $options = $data === [] ? [] : ['json' => $data];

        return $this->httpClient->request('DELETE', $path, $options);
    }

    /**
     * Get the API version.
     *
     * @return string The API version
     */
    public function getApiVersion(): string
    {
        return $this->config->getApiVersion();
    }
}
