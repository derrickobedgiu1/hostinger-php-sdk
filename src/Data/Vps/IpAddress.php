<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents an IP address assigned to a VPS instance.
 */
final class IpAddress extends Data
{
    /** @var int Unique identifier for the IP address record. */
    public int $id;

    /** @var string The actual IP address (IPv4 or IPv6). */
    public string $address;

    /** @var string|null Pointer (PTR) record for reverse DNS lookups. */
    public ?string $ptr;

    /**
     * @param array{
     *      id: int,
     *      address: string,
     *      ptr?: string|null
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->address = $data['address'];
        $this->ptr = $data['ptr'] ?? null;
    }
}
