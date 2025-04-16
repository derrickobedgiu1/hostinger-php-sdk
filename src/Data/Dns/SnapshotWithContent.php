<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Dns;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a DNS snapshot with its content in the Hostinger DNS system.
 */
final class SnapshotWithContent extends Data
{
    /** @var int Unique identifier for the snapshot. */
    public int $id;

    /** @var string Reason for the snapshot creation. */
    public string $reason;

    /** @var array<Name> Contents of the DNS zone records at the time of the snapshot. */
    public array $snapshot;

    /** @var DateTimeImmutable Date and time when the snapshot was created. */
    public DateTimeImmutable $created_at;

    /**
     * @param array{
     *      id: int,
     *      reason: string,
     *      snapshot: array<array{
     *          name: string,
     *          records: array<array{
     *              content: string,
     *              disabled?: bool
     *          }>,
     *          ttl: int,
     *          type: string
     *      }>,
     *      created_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->reason = $data['reason'];
        $this->snapshot = array_map(
            fn (array $record): Name => new Name($record),
            $data['snapshot']
        );
        $this->created_at = new DateTimeImmutable($data['created_at']);
    }
}
