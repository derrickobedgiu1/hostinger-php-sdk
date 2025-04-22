<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a Firewall configuration for VPS instances.
 */
final class Firewall extends Data
{
    /** @var int Unique identifier for the firewall. */
    public int $id;

    /** @var string Display name of the firewall. */
    public string $name;

    /** @var bool Whether the firewall is in sync with all virtual machines using it. */
    public bool $is_synced;

    /** @var array<int, FirewallRule> List of rules defined in this firewall. */
    public array $rules;

    /** @var DateTimeImmutable Date and time when the firewall was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the firewall was last updated. */
    public DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      is_synced: bool,
     *      rules: array<int, array{
     *          id: int,
     *          action: string,
     *          protocol: string,
     *          port: string,
     *          source: string,
     *          source_detail: string
     *      }>,
     *      created_at: string,
     *      updated_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->is_synced = $data['is_synced'];
        $this->rules = array_map(
            fn (array $ruleData): FirewallRule => new FirewallRule($ruleData),
            $data['rules']
        );
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
    }
}
