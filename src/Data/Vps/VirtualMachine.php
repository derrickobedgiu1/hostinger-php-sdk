<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\ActionsLock;
use DerrickOb\HostingerApi\Enums\VirtualMachineState;
use Exception;

/**
 * Represents a virtual private server (VPS) instance.
 */
final class VirtualMachine extends Data
{
    /** @var int Unique identifier for the virtual machine. */
    public int $id;

    /** @var int|null ID of the active firewall group, or null if none. */
    public ?int $firewall_group_id;

    /** @var string Hostname of the virtual machine. */
    public string $hostname;

    /** @var VirtualMachineState Current operational state of the virtual machine. */
    public VirtualMachineState $state;

    /** @var ActionsLock Whether actions are locked for this virtual machine. */
    public ActionsLock $actions_lock;

    /** @var int Number of CPUs allocated to this virtual machine. */
    public int $cpus;

    /** @var int Amount of RAM in MB allocated to this virtual machine. */
    public int $memory;

    /** @var int Amount of disk space in MB allocated to this virtual machine. */
    public int $disk;

    /** @var int Monthly bandwidth limit in MB. */
    public int $bandwidth;

    /** @var string|null Primary nameserver IP address. */
    public ?string $ns1;

    /** @var string|null Secondary nameserver IP address. */
    public ?string $ns2;

    /** @var array<int, IpAddress>|null IPv4 addresses assigned to this virtual machine. */
    public ?array $ipv4;

    /** @var array<int, IpAddress>|null IPv6 addresses assigned to this virtual machine. */
    public ?array $ipv6;

    /** @var OsTemplate|null OS template installed on this virtual machine. */
    public ?OsTemplate $template;

    /** @var DateTimeImmutable Date and time when the virtual machine was created. */
    public DateTimeImmutable $created_at;

    /**
     * @param array{
     *      id: int,
     *      firewall_group_id?: int|null,
     *      hostname: string,
     *      state: string,
     *      actions_lock: string,
     *      cpus: int,
     *      memory: int,
     *      disk: int,
     *      bandwidth: int,
     *      ns1?: string|null,
     *      ns2?: string|null,
     *      ipv4?: array<int, array{
     *          id: int,
     *          address: string,
     *          ptr?: string|null
     *      }>|null,
     *      ipv6?: array<int, array{
     *          id: int,
     *          address: string,
     *          ptr?: string|null
     *      }>|null,
     *      template?: array{
     *          id: int,
     *          name: string,
     *          description: string,
     *          documentation?: string|null
     *      }|null,
     *      created_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->firewall_group_id = $data['firewall_group_id'] ?? null;
        $this->hostname = $data['hostname'];
        $this->state = VirtualMachineState::from($data['state']);
        $this->actions_lock = ActionsLock::from($data['actions_lock']);
        $this->cpus = $data['cpus'];
        $this->memory = $data['memory'];
        $this->disk = $data['disk'];
        $this->bandwidth = $data['bandwidth'];
        $this->ns1 = $data['ns1'] ?? null;
        $this->ns2 = $data['ns2'] ?? null;

        if (isset($data['ipv4'])) {
            $this->ipv4 = array_map(
                fn (array $ipData): IpAddress => new IpAddress($ipData),
                $data['ipv4']
            );
        } else {
            $this->ipv4 = null;
        }

        if (isset($data['ipv6'])) {
            $this->ipv6 = array_map(
                fn (array $ipData): IpAddress => new IpAddress($ipData),
                $data['ipv6']
            );
        } else {
            $this->ipv6 = null;
        }

        $this->template = isset($data['template']) ? new OsTemplate($data['template']) : null;
        $this->created_at = new DateTimeImmutable($data['created_at']);
    }
}
