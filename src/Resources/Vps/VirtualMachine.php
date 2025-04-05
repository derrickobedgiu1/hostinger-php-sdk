<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Metrics;
use DerrickOb\HostingerApi\Data\Vps\VirtualMachine as VirtualMachineData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Virtual Machines API.
 *
 * @link https://developers.hostinger.com/#tag/vps-virtual-machine
 */
final class VirtualMachine extends Resource
{
    /**
     * Get virtual machine list.
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines
     *
     * @return array<VirtualMachineData> List of virtual machines
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines', $version));

        /** @var array<VirtualMachineData> */
        return $this->transformResponse(VirtualMachineData::class, $response);
    }

    /**
     * Get virtual machine details.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return VirtualMachineData The virtual machine details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}
     *
     */
    public function get(int $virtualMachineId): VirtualMachineData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d', $version, $virtualMachineId));

        /** @var VirtualMachineData */
        return $this->transformResponse(VirtualMachineData::class, $response);
    }

    /**
     * Setup new virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     template_id: int,
     *     data_center_id: int,
     *     password: string,
     *     hostname?: string,
     *     install_monarx?: bool,
     *     enable_backups?: bool,
     *     ns1?: string,
     *     ns2?: string,
     *     public_key?: array{
     *         name: string,
     *         key: string
     *     }
     * } $data Setup data for the virtual machine
     *
     * @return VirtualMachineData The setup virtual machine
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/setup
     *
     */
    public function setup(int $virtualMachineId, array $data): VirtualMachineData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/setup', $version, $virtualMachineId), $data);

        /** @var VirtualMachineData */
        return $this->transformResponse(VirtualMachineData::class, $response);
    }

    /**
     * Start a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated start action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/start
     *
     */
    public function start(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/start', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Stop a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated stop action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/stop
     *
     */
    public function stop(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/stop', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Restart a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated restart action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/restart
     *
     */
    public function restart(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/restart', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Reinstall a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     password: string,
     *     template_id: int
     * } $data Reinstall data with new password and template
     *
     * @return Action The initiated reinstall action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/reinstall
     *
     */
    public function reinstall(int $virtualMachineId, array $data): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/reinstall', $version, $virtualMachineId), $data);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Set hostname for a virtual machine.
     *
     * @param int    $virtualMachineId Virtual machine ID
     * @param string $hostname         New hostname
     *
     * @return Action The initiated hostname change action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/hostname
     *
     */
    public function setHostName(int $virtualMachineId, string $hostname): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/virtual-machines/%d/hostname', $version, $virtualMachineId), [
            'hostname' => $hostname,
        ]);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Reset hostname for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated hostname reset action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/hostname
     *
     */
    public function resetHostName(int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/hostname', $version, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Set root password for a virtual machine.
     *
     * @param int    $virtualMachineId Virtual machine ID
     * @param string $password         New root password
     *
     * @return Action The initiated password change action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/root-password
     *
     */
    public function setRootPassword(int $virtualMachineId, string $password): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/virtual-machines/%d/root-password', $version, $virtualMachineId), [
            'password' => $password,
        ]);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Set panel password for a virtual machine.
     *
     * @param int    $virtualMachineId Virtual machine ID
     * @param string $password         New panel password
     *
     * @return Action The initiated password change action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/panel-password
     *
     */
    public function setPanelPassword(int $virtualMachineId, string $password): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/virtual-machines/%d/panel-password', $version, $virtualMachineId), [
            'password' => $password,
        ]);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Set nameservers for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     ns1: string,
     *     ns2?: string
     * } $data Nameserver data
     *
     * @return Action The initiated nameserver change action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/nameservers
     *
     */
    public function setNameServers(int $virtualMachineId, array $data): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/virtual-machines/%d/nameservers', $version, $virtualMachineId), $data);

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Get metrics for a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     date_from: string,
     *     date_to: string
     * } $data Metrics request data with date range
     *
     * @return Metrics The virtual machine metrics
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}/metrics
     *
     */
    public function getMetrics(int $virtualMachineId, array $data): Metrics
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/metrics', $version, $virtualMachineId), $data);

        /** @var Metrics */
        return $this->transformResponse(Metrics::class, $response);
    }
}
