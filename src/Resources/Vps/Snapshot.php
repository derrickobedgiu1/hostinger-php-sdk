<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Snapshot as SnapshotData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Snapshots API.
 *
 * @link https://developers.hostinger.com/#tag/vps-snapshots
 */
final class Snapshot extends AbstractResource
{
    /**
     * Get snapshot details for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/GET/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     * @return SnapshotData The snapshot details
     *
     */
    public function get(int $virtualMachineId): SnapshotData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var SnapshotData */
        return $this->transformResponse(SnapshotData::class, $response);
    }

    /**
     * Create snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     * @return Action The initiated snapshot creation action
     *
     */
    public function create(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Delete snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     * @return Action The initiated snapshot deletion action
     *
     */
    public function delete(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Restore snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot/restore
     *
     * @return Action The initiated snapshot restoration action
     *
     */
    public function restore(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/snapshot/restore', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }
}
