<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a WHOIS contact profile.
 */
final class WhoisProfile extends Data
{
    /** @var int Unique identifier for the WHOIS profile. */
    public int $id;

    /** @var string TLD this profile can be applied to. */
    public string $tld;

    /** @var string ISO 3166 2-letter country code. */
    public string $country;

    /** @var string Legal entity type ('individual' or 'organization'). */
    public string $entity_type;

    /** @var array<string, mixed> WHOIS profile details. */
    public array $whois_details;

    /** @var array<string, mixed>|null TLD-specific details. */
    public ?array $tld_details;

    /** @var DateTimeImmutable Date and time when the profile was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the profile was last updated. */
    public DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      id: int,
     *      tld: string,
     *      country: string,
     *      entity_type: string,
     *      whois_details: array<string, mixed>,
     *      tld_details?: array<string, mixed>|null,
     *      created_at: string,
     *      updated_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->tld = $data['tld'];
        $this->country = $data['country'];
        $this->entity_type = $data['entity_type'];
        $this->whois_details = $data['whois_details'];
        $this->tld_details = $data['tld_details'] ?? null;
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
    }
}
