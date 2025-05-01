<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\DomainStatus;
use DerrickOb\HostingerApi\Enums\DomainType;
use Exception;

/**
 * Represents a Domain in the Hostinger domains System.
 */
final class Domain extends Data
{
    /** @var int Unique identifier for the domain. */
    public int $id;

    /** @var string|null Domain name, null when not claimed free domain. */
    public ?string $domain;

    /** @var DomainType The type of the domain, either free or paid. */
    public DomainType $type;

    /** @var DomainStatus Current status of the domain. */
    public DomainStatus $status;

    /** @var DateTimeImmutable Date and time when the domain was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable|null Date and time when the domain expires. */
    public ?DateTimeImmutable $expires_at;

    /**
     * @param array{
     *      id: int,
     *      domain?: string|null,
     *      type: string,
     *      status: string,
     *      created_at: string,
     *      expires_at?: string|null
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->domain = $data['domain'] ?? null;
        $this->type = DomainType::from($data['type']);
        $this->status = DomainStatus::from($data['status']);
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->expires_at = isset($data['expires_at']) ? new DateTimeImmutable($data['expires_at']) : null;
    }
}
