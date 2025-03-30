<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Metrics;
use DerrickOb\HostingerApi\Data\Vps\VirtualMachine as VirtualMachineData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Virtual Machines API.
 *
 * @link https://developers.hostinger.com/#tag/vps-virtual-machine
 */
final class VirtualMachine extends AbstractResource
{
    /**
     * Get virtual machine list.
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines
     *
     * @return array<VirtualMachineData> List of virtual machines
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}
     *
     * @return VirtualMachineData The virtual machine details
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/setup
     *
     * @return VirtualMachineData The setup virtual machine
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/start
     *
     * @return Action The initiated start action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/stop
     *
     * @return Action The initiated stop action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/restart
     *
     * @return Action The initiated restart action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/reinstall
     *
     * @return Action The initiated reinstall action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/hostname
     *
     * @return Action The initiated hostname change action
     *
     */
    public function setHostname(int $virtualMachineId, string $hostname): Action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/hostname
     *
     * @return Action The initiated hostname reset action
     *
     */
    public function resetHostname(int $virtualMachineId): Action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/root-password
     *
     * @return Action The initiated password change action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/panel-password
     *
     * @return Action The initiated password change action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/nameservers
     *
     * @return Action The initiated nameserver change action
     *
     */
    public function setNameservers(int $virtualMachineId, array $data): Action
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
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}/metrics
     *
     * @return Metrics The virtual machine metrics
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
