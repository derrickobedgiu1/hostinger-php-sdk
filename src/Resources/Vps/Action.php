<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
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
     * @param int           $virtualMachineId Virtual machine ID
     * @param array<string> $query            Optional query parameters (like page)
     *
     * @return PaginatedResponse The actions list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions
     *
     */
    public function list(int $virtualMachineId, array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/actions', $version, $virtualMachineId), $query);

        /** @var PaginatedResponse */
        return $this->transformResponse(ActionData::class, $response);
    }

    /**
     * Get action details.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param int $actionId         Action ID
     *
     * @return ActionData The action details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions/{actionId}
     *
     */
    public function get(int $virtualMachineId, int $actionId): ActionData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/actions/%d', $version, $virtualMachineId, $actionId));

        /** @var ActionData */
        return $this->transformResponse(ActionData::class, $response);
    }
}
