<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Snapshot as SnapshotData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Snapshots API.
 *
 * @link https://developers.hostinger.com/#tag/vps-snapshots
 */
final class Snapshot extends Resource
{
    /**
     * Get snapshot details for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return SnapshotData The snapshot details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/GET/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     */
    public function get(int $virtualMachineId): SnapshotData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var SnapshotData */
        return $this->transform(SnapshotData::class, $response);
    }

    /**
     * Create snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated snapshot creation action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     */
    public function create(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var Action */
        return $this->transform(Action::class, $response);
    }

    /**
     * Delete snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated snapshot deletion action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot
     *
     */
    public function delete(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/snapshot', $version, $virtualMachineId));

        /** @var Action */
        return $this->transform(Action::class, $response);
    }

    /**
     * Restore snapshot for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated snapshot restoration action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot/restore
     *
     */
    public function restore(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/snapshot/restore', $version, $virtualMachineId));

        /** @var Action */
        return $this->transform(Action::class, $response);
    }
}
