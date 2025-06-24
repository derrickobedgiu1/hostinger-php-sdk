<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Billing\Order;
use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a VPS Virtual Machine purchase order response.
 */
final class VirtualMachineOrder extends Data
{
    /** @var Order Order details and billing information. */
    public Order $order;

    /** @var VirtualMachine Virtual machine information. */
    public VirtualMachine $virtual_machine;

    /**
     * @param array{
     *      order: array{id: int, subscription_id?: string, status: string, currency: string, subtotal: int, total: int, billing_address: array{first_name: string, last_name: string, company?: string|null, address_1?: string|null, address_2?: string|null, city?: string|null, state?: string|null, zip?: string|null, country?: string|null, phone?: string|null, email: string}, created_at: string, updated_at: string},
     *      virtual_machine: array{id: int, firewall_group_id?: int|null, subscription_id?: string|null, plan?: string|null, hostname: string, state: string, actions_lock: string, cpus: int, memory: int, disk: int, bandwidth: int, ns1?: string|null, ns2?: string|null, ipv4?: array<array{id: int, address: string, ptr?: string|null}>|null, ipv6?: array<array{id: int, address: string, ptr?: string|null}>|null, template?: array{id: int, name: string, description: string, documentation?: string|null}|null, created_at: string}
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->order = new Order($data['order']);
        $this->virtual_machine = new VirtualMachine($data['virtual_machine']);
    }
}
