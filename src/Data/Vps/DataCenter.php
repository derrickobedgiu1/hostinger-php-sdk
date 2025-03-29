<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a Data center where VPS instances can be hosted.
 */
final class DataCenter extends Data
{
    /** @var int Unique identifier for the data center. */
    public int $id;

    /** @var string|null Short code name of the data center. */
    public ?string $name;

    /** @var string|null Two-letter country code where the data center is located. */
    public ?string $location;

    /** @var string|null City where the data center is located. */
    public ?string $city;

    /** @var string|null Continent where the data center is located. */
    public ?string $continent;

    /**
     * @param array{
     *      id: int,
     *      name?: string|null,
     *      location?: string|null,
     *      city?: string|null,
     *      continent?: string|null
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'] ?? null;
        $this->location = $data['location'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->continent = $data['continent'] ?? null;
    }
}
