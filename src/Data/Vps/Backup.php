<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a Backup of a VPS instance.
 */
final class Backup extends Data
{
    /** @var int Unique identifier for the backup. */
    public int $id;

    /** @var string Storage location of the backup. */
    public string $location;

    /** @var DateTimeImmutable Date and time when the backup was created. */
    public DateTimeImmutable $created_at;

    /**
     * @param array{
     *      id: int,
     *      location: string,
     *      created_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->location = $data['location'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
    }
}
