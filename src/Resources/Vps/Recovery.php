<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Recovery Mode API
 *
 * @link https://developers.hostinger.com/#tag/vps-recovery.
 */
final class Recovery extends Resource
{
    /**
     * Start recovery mode for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     root_password: string
     * } $data Recovery mode data with root password
     *
     * @return Action The initiated recovery start action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-recovery/POST/api/vps/v1/virtual-machines/{virtualMachineId}/recovery
     *
     */
    public function start(int $virtualMachineId, array $data): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/recovery', $version, $virtualMachineId), $data);

        /** @var Action */
        return $this->transform(Action::class, $response);
    }

    /**
     * Stop recovery mode for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated recovery stop action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-recovery/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/recovery
     *
     */
    public function stop(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/recovery', $version, $virtualMachineId));

        /** @var Action */
        return $this->transform(Action::class, $response);
    }
}
