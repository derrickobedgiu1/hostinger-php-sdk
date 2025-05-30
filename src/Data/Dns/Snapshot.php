<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Dns;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a DNS snapshot in the Hostinger DNS system.
 */
final class Snapshot extends Data
{
    /** @var int Unique identifier for the snapshot. */
    public int $id;

    /** @var string Reason for the snapshot creation. */
    public string $reason;

    /** @var DateTimeImmutable Date and time when the snapshot was created. */
    public DateTimeImmutable $created_at;

    /**
     * @param array{
     *      id: int,
     *      reason: string,
     *      created_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->reason = $data['reason'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
    }
}
