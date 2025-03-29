<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents an operating system template available for VPS instances.
 */
final class OsTemplate extends Data
{
    /** @var int Unique identifier for the OS template. */
    public int $id;

    /** @var string Display name of the OS template. */
    public string $name;

    /** @var string Detailed description of the OS template. */
    public string $description;

    /** @var string|null URL to the official documentation for this OS. */
    public ?string $documentation;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      description: string,
     *      documentation?: string|null
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->documentation = $data['documentation'] ?? null;
    }
}
