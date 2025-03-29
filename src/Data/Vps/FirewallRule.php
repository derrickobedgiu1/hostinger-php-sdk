<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\FirewallAction;
use DerrickOb\HostingerApi\Enums\Protocol;
use DerrickOb\HostingerApi\Enums\Source;

/**
 * Represents a rule within a firewall configuration.
 */
final class FirewallRule extends Data
{
    /** @var int Unique identifier for the firewall rule. */
    public int $id;

    /** @var FirewallAction Action to take when rule matches (accept or drop). */
    public FirewallAction $action;

    /** @var Protocol Network protocol this rule applies to. */
    public Protocol $protocol;

    /** @var string Port or port range this rule applies to. */
    public string $port;

    /** @var Source Source type for this rule. */
    public Source $source;

    /** @var string Specific source details (IP, CIDR, etc). */
    public string $source_detail;

    /**
     * @param array{
     *      id: int,
     *      action: string,
     *      protocol: string,
     *      port: string,
     *      source: string,
     *      source_detail: string
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->action = FirewallAction::from($data['action']);
        $this->protocol = Protocol::from($data['protocol']);
        $this->port = $data['port'];
        $this->source = Source::from($data['source']);
        $this->source_detail = $data['source_detail'];
    }
}
