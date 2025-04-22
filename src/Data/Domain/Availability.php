<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents the availability status of a domain name.
 */
final class Availability extends Data
{
    /** @var string Domain name checked. */
    public string $domain;

    /** @var bool Whether the domain is available for registration. */
    public bool $is_available;

    /** @var bool Whether this domain was provided as an alternative suggestion. */
    public bool $is_alternative;

    /** @var string|null Special rules or restrictions for registering this TLD. */
    public ?string $restriction;

    /**
     * @param array{
     *      domain: string,
     *      is_available: bool,
     *      is_alternative: bool,
     *      restriction?: string|null
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->domain = $data['domain'];
        $this->is_available = $data['is_available'];
        $this->is_alternative = $data['is_alternative'];
        $this->restriction = $data['restriction'] ?? null;
    }
}
