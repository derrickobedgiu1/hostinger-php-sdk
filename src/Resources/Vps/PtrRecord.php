<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS PTR Records API.
 *
 * @link https://developers.hostinger.com/#tag/vps-ptr-records
 */
final class PtrRecord extends AbstractResource
{
    /**
     * Create PTR record for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated creation action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-ptr-records/POST/api/vps/v1/virtual-machines/{virtualMachineId}/ptr
     *
     */
    public function create(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/ptr', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Delete PTR record for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated deletion action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-ptr-records/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/ptr
     *
     */
    public function delete(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/ptr', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }
}
