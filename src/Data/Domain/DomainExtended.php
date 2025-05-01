<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\DomainStatus;
use Exception;

/**
 * Represents extended details of a Domain in the Hostinger domains System.
 */
final class DomainExtended extends Data
{
    /** @var string Domain name. */
    public string $domain;

    /** @var DomainStatus Current status of the domain. */
    public DomainStatus $status;

    /** @var string|null Additional message related to the status. */
    public ?string $message;

    /** @var bool Whether privacy protection is allowed for this domain. */
    public bool $is_privacy_protection_allowed;

    /** @var bool Whether privacy protection is currently enabled. */
    public bool $is_privacy_protected;

    /** @var bool Whether the domain can be locked. */
    public bool $is_lockable;

    /** @var bool Whether the domain is currently locked. */
    public bool $is_locked;

    /** @var array{ns1: string, ns2: string}|null Current nameservers. */
    public ?array $name_servers;

    /** @var array<string, array<string>>|null Child nameservers. */
    public ?array $child_name_servers;

    /** @var array{admin_id: int, owner_id: int, billing_id: int, tech_id: int}|null WHOIS contact profile IDs. */
    public ?array $domain_contacts;

    /** @var DateTimeImmutable Date and time when the domain record was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the domain record was last updated. */
    public DateTimeImmutable $updated_at;

    /** @var DateTimeImmutable|null Date and time when the 60-day transfer lock expires. */
    public ?DateTimeImmutable $sixty_days_lock_expires_at;

    /** @var DateTimeImmutable|null Date and time when the domain was registered. */
    public ?DateTimeImmutable $registered_at;

    /** @var DateTimeImmutable|null Date and time when the domain expires. */
    public ?DateTimeImmutable $expires_at;

    /**
     * @param array{
     *      domain: string,
     *      status: string,
     *      message?: string|null,
     *      is_privacy_protection_allowed: bool,
     *      is_privacy_protected: bool,
     *      is_lockable: bool,
     *      is_locked: bool,
     *      name_servers?: array{ns1: string, ns2: string}|null,
     *      child_name_servers?: array<string, array<string>>|null,
     *      domain_contacts?: array{admin_id: int, owner_id: int, billing_id: int, tech_id: int}|null,
     *      created_at: string,
     *      updated_at: string,
     *      "60_days_lock_expires_at"?: string|null,
     *      registered_at?: string|null,
     *      expires_at?: string|null
     *  } $data
     *
     * @throws Exception
    */
    public function __construct(array $data)
    {
        $this->domain = $data['domain'];
        $this->status = DomainStatus::from($data['status']);
        $this->message = $data['message'] ?? null;
        $this->is_privacy_protection_allowed = $data['is_privacy_protection_allowed'];
        $this->is_privacy_protected = $data['is_privacy_protected'];
        $this->is_lockable = $data['is_lockable'];
        $this->is_locked = $data['is_locked'];
        $this->name_servers = $data['name_servers'] ?? null;
        $this->child_name_servers = $data['child_name_servers'] ?? null;
        $this->domain_contacts = $data['domain_contacts'] ?? null;
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
        $this->sixty_days_lock_expires_at = isset($data['60_days_lock_expires_at']) ? new DateTimeImmutable($data['60_days_lock_expires_at']) : null;
        $this->registered_at = isset($data['registered_at']) ? new DateTimeImmutable($data['registered_at']) : null;
        $this->expires_at = isset($data['expires_at']) ? new DateTimeImmutable($data['expires_at']) : null;
    }
}
