<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data;

/**
 * Factory for creating appropriate data objects from API responses.
 */
final class ResponseFactory
{
    /**
     * Create a single DTO from an API response.
     *
     * @template T of Data
     *
     * @param class-string<T>      $class Data class to instantiate
     * @param array<string, mixed> $data  Raw API response data
     *
     * @return T Instance of the specified data class
     */
    public static function create(string $class, array $data): Data
    {
        return new $class($data);
    }

    /**
     * Create a collection of DTOs from an API response.
     *
     * @template T of Data
     *
     * @param class-string<T>                  $class Data class to instantiate for each item
     * @param array<int, array<string, mixed>> $data  Raw items array from API
     *
     * @return array<int, T> Array of specified data class instances
     */
    public static function createCollection(string $class, array $data): array
    {
        if ($data === []) {
            return [];
        }

        return array_map(
            fn (array $item): object => new $class($item),
            $data
        );
    }

    /**
     * Create a paginated response from an API response.
     *
     * @template T of Data
     *
     * @param class-string<T> $class Data class to instantiate for each item
     * @param array{
     *     data: array<array<string, mixed>>,
     *     meta?: array{
     *         current_page: int,
     *         per_page: int,
     *         total: int
     *     }
     * } $response Raw paginated response from API
     *
     * @return PaginatedResponse Paginated response containing instances of the specified class
     */
    public static function createPaginated(string $class, array $response): PaginatedResponse
    {
        return new PaginatedResponse($response, $class);
    }

    /**
     * Create the appropriate response type based on the API response structure.
     *
     * @template T of Data
     *
     * @param class-string<T>          $class    Data class to instantiate
     * @param array<string|int, mixed> $response Raw API response
     *
     * @return T|array<int, T>|PaginatedResponse Single data object, array of data objects,
     *                                           or paginated response depending on the response structure
     */
    public static function createResponse(string $class, array $response): mixed
    {
        if ($response === []) {
            return [];
        }

        // If response contains 'data' and 'meta' keys, it's paginated
        if (isset($response['data']) && isset($response['meta'])) {
            return self::createPaginated($class, $response);
        }

        // If response is a numerically indexed array, it's a collection
        if (array_keys($response) === range(0, count($response) - 1)) {
            return self::createCollection($class, $response);
        }

        // If response is a single object, create a single Data Object
        return self::create($class, $response);
    }
}
