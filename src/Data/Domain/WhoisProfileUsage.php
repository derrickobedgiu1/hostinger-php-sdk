<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents the usage of a WHOIS profile.
 */
final class WhoisProfileUsage extends Data
{
    /**
     * @param array<string> $domains List of domain names using the profile.
     */
    public function __construct(public array $domains)
    {
    }

    /**
     * Override fromArray to handle simple array response.
     *
     * @param array<string> $data Raw data from API (array of domain strings)
     *
     * @return static New instance of the called class
     */
    public static function fromArray(array $data): static
    {
        return new self($data);
    }

    /**
     * Override collection to handle simple array response.
     *
     * This DTO represents a list directly, so the 'collection' method
     * takes the raw array of domain strings from the API response.
     *
     * @param array<int|string, string> $items Array of domain strings from API
     *
     * @return array<int, static> An array containing a single instance of WhoisProfileUsage
     */
    public static function collection(array $items): array
    {
        return [new self($items)];
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array<string> The list of domains
     */
    public function toArray(): array
    {
        return $this->domains;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array<string> Data to be serialized
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
