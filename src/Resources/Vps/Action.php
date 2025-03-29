<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Actions API.
 *
 * @link https://developers.hostinger.com/#tag/vps-actions
 */
final class Action extends AbstractResource
{
    /**
     * Get action list for a virtual machine.
     *
     * @param int           $vmId  Virtual machine ID
     * @param array<string> $query Optional query parameters (like page)
     *
     * @link https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions
     *
     * @return PaginatedResponse The actions list
     *
     */
    public function list(int $vmId, array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/actions', $version, $vmId), $query);

        /** @var PaginatedResponse */
        return $this->transformResponse(ActionData::class, $response);
    }

    /**
     * Get action details.
     *
     * @param int $vmId     Virtual machine ID
     * @param int $actionId Action ID
     *
     * @link https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions/{actionId}
     *
     * @return ActionData The action details
     *
     */
    public function get(int $vmId, int $actionId): ActionData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/actions/%d', $version, $vmId, $actionId));

        /** @var ActionData */
        return $this->transformResponse(ActionData::class, $response);
    }
}
