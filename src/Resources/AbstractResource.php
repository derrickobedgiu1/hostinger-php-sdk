<?php

namespace DerrickOb\HostingerApi\Resources;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\ResponseFactory;

/**
 * Base abstract class for all API resource endpoints.
 */
abstract class AbstractResource
{
    /**
     * @param ClientInterface $client The API client for making requests.
     */
    public function __construct(protected ClientInterface $client)
    {
    }

    /**
     * Get the API version for requests.
     *
     * @return string The API version.
     */
    protected function getApiVersion(): string
    {
        return $this->client->getApiVersion();
    }

    /**
     * Transform API response into the appropriate data object(s).
     *
     * @template T of Data
     *
     * @param class-string<T>          $dataClass The data class to transform into
     * @param array<string|int, mixed> $response  The API response to transform
     *
     * @return T|array<int, T>|PaginatedResponse The transformed response
     */
    protected function transformResponse(string $dataClass, array $response): mixed
    {
        return ResponseFactory::createResponse($dataClass, $response);
    }
}
