<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Dns;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a DNS name in the Hostinger DNS system.
 */
final class Name extends Data
{
    /** @var string Name of the record (use `@` for wildcard name). */
    public string $name;

    /** @var array<NameRecord> Records associated with this name. */
    public array $records;

    /** @var int TTL (Time-To-Live) of the record. */
    public int $ttl;

    /** @var string Type of the record (A, AAAA, CNAME, etc.). */
    public string $type;

    /**
     * @param array{
     *      name: string,
     *      records: array<array{
     *          content: string,
     *          disabled?: bool
     *      }>,
     *      ttl: int,
     *      type: string
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->records = array_map(
            fn (array $recordData): NameRecord => new NameRecord($recordData),
            $data['records']
        );
        $this->ttl = $data['ttl'];
        $this->type = $data['type'];
    }
}
