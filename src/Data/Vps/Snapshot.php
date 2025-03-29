<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a snapshot of a VPS instance at a specific point in time.
 */
final class Snapshot extends Data
{
    /** @var int Unique identifier for the snapshot. */
    public int $id;

    /** @var DateTimeImmutable Date and time when the snapshot was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the snapshot expires. */
    public DateTimeImmutable $expires_at;

    /**
     * @param array{
     *      id: int,
     *      created_at: string,
     *      expires_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->expires_at = new DateTimeImmutable($data['expires_at']);
    }
}
