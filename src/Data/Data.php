<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data;

/**
 * Base abstract class for all data objects in the SDK.
 */
abstract class Data implements \JsonSerializable
{
    /**
     * Create a new DTO instance from raw data.
     *
     * @param array<string, mixed> $data Raw data from API
     *
     * @return static New instance of the called class
     */
    public static function fromArray(array $data): static
    {
        // @phpstan-ignore-next-line
        return new static($data);
    }

    /**
     * Create a collection of DTOs from raw data.
     *
     * @param array<int|string, array<string, mixed>> $items Array of raw items from API
     *
     * @return array<int|string, static> Collection of DTO instances
     */
    public static function collection(array $items): array
    {
        return array_map(fn ($data): static => static::fromArray($data), $items);
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed> The object properties as an array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array<string, mixed> Data to be serialized
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
