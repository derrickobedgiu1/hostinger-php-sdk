<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data;

/**
 * Represents a paginated response from the API.
 */
final class PaginatedResponse implements \JsonSerializable
{
    /** @var array<Data> Array of data objects in the current page. */
    private readonly array $data;

    /**
     * @var array{
     *      current_page: int,
     *      per_page: int,
     *      total: int,
     *  } Pagination metadata.
     */
    private array $meta;

    /**
     * @param array{
     *      data: array<array<string, mixed>>,
     *      meta?: array{
     *          current_page: int,
     *          per_page: int,
     *          total: int
     *      }
     *  } $response  Raw API response
     * @param class-string<Data> $itemClass The DTO class for the items
     */
    public function __construct(array $response, string $itemClass)
    {
        $this->meta = $response['meta'] ?? [
            'current_page' => 1,
            'per_page' => count($response['data']),
            'total' => count($response['data']),
        ];

        $this->data = array_map(
            fn (array $item): object => new $itemClass($item),
            $response['data']
        );
    }

    /**
     * Get the data items in this page.
     *
     * @return array<Data> Array of data objects
     */
    public function getData(): array
    {
        /** @var array<int, Data> */
        return $this->data;
    }

    /**
     * Get pagination metadata.
     *
     * @return array{
     *     current_page: int,
     *     per_page: int,
     *     total: int
     * } The pagination metadata
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * Get current page number.
     *
     * @return int The current page number
     */
    public function getCurrentPage(): int
    {
        return $this->meta['current_page'] ?? 1;
    }

    /**
     * Get items per page.
     *
     * @return int The number of items per page
     */
    public function getPerPage(): int
    {
        return $this->meta['per_page'] ?? count($this->data);
    }

    /**
     * Get total number of items across all pages.
     *
     * @return int The total number of items
     */
    public function getTotal(): int
    {
        return $this->meta['total'] ?? count($this->data);
    }

    /**
     * Convert to array.
     *
     * @return array{
     *     data: array<array<string, mixed>>,
     *     meta: array{
     *         current_page: int,
     *         per_page: int,
     *         total: int
     *     }
     * } The paginated response as an array
     */
    public function toArray(): array
    {
        return [
            'data' => array_map(
                fn (Data $item): array => $item->toArray(),
                $this->data
            ),
            'meta' => $this->meta,
        ];
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array{
     *     data: array<array<string, mixed>>,
     *     meta: array{
     *         current_page: int,
     *         per_page: int,
     *         total: int
     *     }
     * } Data to be serialized
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
