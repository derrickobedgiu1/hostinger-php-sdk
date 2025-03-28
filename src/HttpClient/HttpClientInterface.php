<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\HttpClient;

use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;

/**
 * Interface for HTTP clients making API requests.
 */
interface HttpClientInterface
{
    /**
     * Send a request to the API.
     *
     * @param string               $method  HTTP method (GET, POST, PUT, DELETE)
     * @param string               $uri     URI path
     * @param array<string, mixed> $options Request options
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function request(string $method, string $uri, array $options = []): array;
}
