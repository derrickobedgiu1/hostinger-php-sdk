<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;

/**
 * Interface for the Hostinger API client.
 */
interface ClientInterface
{
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
    public function get(string $path, array $query = []): array;

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
    public function post(string $path, array $data = []): array;

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
    public function put(string $path, array $data = []): array;

    /**
     * Send a DELETE request.
     *
     * @param string $path API endpoint path
     *
     * @return array<string, mixed> Response data
     *
     * @throws AuthenticationException When authentication fails
     * @throws ValidationException     When validation fails
     * @throws RateLimitException      When rate limit is exceeded
     * @throws ApiException            For other API errors
     */
    public function delete(string $path): array;

    /**
     * Get the API version.
     *
     * @return string The API version
     */
    public function getApiVersion(): string;
}
