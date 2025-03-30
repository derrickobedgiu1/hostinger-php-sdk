<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Recovery Mode API
 *
 * @link https://developers.hostinger.com/#tag/vps-recovery.
 */
final class Recovery extends AbstractResource
{
    /**
     * Start recovery mode for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     root_password: string
     * } $data Recovery mode data with root password
     *
     * @link https://developers.hostinger.com/#tag/vps-recovery/POST/api/vps/v1/virtual-machines/{virtualMachineId}/recovery
     *
     * @return Action The initiated recovery start action
     *
     */
    public function start(int $virtualMachineId, array $data): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/recovery', $version, $virtualMachineId), $data);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Stop recovery mode for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @link https://developers.hostinger.com/#tag/vps-recovery/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/recovery
     *
     * @return Action The initiated recovery stop action
     *
     */
    public function stop(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/recovery', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }
}
