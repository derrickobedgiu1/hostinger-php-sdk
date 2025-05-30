<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Billing\Order;
use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Metrics;
use DerrickOb\HostingerApi\Data\Vps\PublicKey;
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
        return $this->transform(VirtualMachineData::class, $response);
    }

    /**
     * Purchase new virtual machine.
     *
     * Allows you to buy (purchase) and setup a new virtual machine.
     * If virtual machine setup fails for any reason, login to hPanel and complete the setup manually.
     * If no payment method is provided, your default payment method will be used automatically.
     *
     * @param array{
     *      item_id: string,
     *      payment_method_id?: int,
     *      setup: array{
     *          template_id: int,
     *          data_center_id: int,
     *          password?: string,
     *          hostname?: string,
     *          install_monarx?: bool,
     *          enable_backups?: bool,
     *          ns1?: string,
     *          ns2?: string,
     *          post_install_script_id?: int,
     *          public_key?: array{
     *              name: string,
     *              key: string
     *          }
     *      },
     *      coupons?: array<int, string>
     *  } $data Purchase and setup data for the virtual machine
     *
     * @return Order The resulting order details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines
     */
    public function purchase(array $data): Order
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines', $version), $data);

        /** @var Order */
        return $this->transform(Order::class, $response);
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
        return $this->transform(VirtualMachineData::class, $response);
    }

    /**
     * Setup new virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     template_id: int,
     *     data_center_id: int,
     *     password?: string,
     *     hostname?: string,
     *     install_monarx?: bool,
     *     enable_backups?: bool,
     *     ns1?: string,
     *     ns2?: string,
     *     post_install_script_id?: int,
     *     public_key?: array{
     *         name: string,
     *         key: string
     *     }
     * } $data Setup data for the virtual machine.
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
        return $this->transform(VirtualMachineData::class, $response);
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
        return $this->transform(Action::class, $response);
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
        return $this->transform(Action::class, $response);
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
        return $this->transform(Action::class, $response);
    }

    /**
     * Recreate a virtual machine.
     *
     * This will recreate a virtual machine from scratch with a fresh OS installation.
     * All data will be lost. Snapshots will be deleted.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     template_id: int,
     *     password?: string,
     *     post_install_script_id?: int
     * } $data Recreation data with template ID and optional password
     *
     * @return Action The initiated recreate action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/recreate
     *
     */
    public function recreate(int $virtualMachineId, array $data): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/recreate', $version, $virtualMachineId), $data);

        /** @var Action */
        return $this->transform(Action::class, $response);
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
        return $this->transform(Action::class, $response);
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
        return $this->transform(Action::class, $response);
    }

    /**
     * Set root password for a virtual machine.
     *
     * Password will be checked against leaked password databases.
     * Requirements for the password are:
     * - At least 8 characters long
     * - At least one uppercase letter
     * - At least one lowercase letter
     * - At least one number
     * - Is not leaked publicly
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
        return $this->transform(Action::class, $response);
    }

    /**
     * Set panel password for a virtual machine.
     *
     * Password will be checked against leaked password databases.
     * Requirements for the password are:
     * - At least 8 characters long
     * - At least one uppercase letter
     * - At least one lowercase letter
     * - At least one number
     * - Is not leaked publicly
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
        return $this->transform(Action::class, $response);
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
        return $this->transform(Action::class, $response);
    }

    /**
     * Get metrics for a virtual machine.
     *
     * @param int    $virtualMachineId Virtual machine ID
     * @param string $dateFrom         Start date (RFC 3339 format)
     * @param string $dateTo           End date (RFC 3339 format)
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
    public function getMetrics(int $virtualMachineId, string $dateFrom, string $dateTo): Metrics
    {
        $version = $this->getApiVersion();
        $query = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];

        $response = $this->client->get(
            sprintf('/api/vps/%s/virtual-machines/%d/metrics', $version, $virtualMachineId),
            $query
        );

        /** @var Metrics */
        return $this->transform(Metrics::class, $response);
    }

    /**
     * Get attached public keys for a virtual machine.
     *
     * @param int                  $virtualMachineId Virtual machine ID
     * @param array<string, mixed> $query            Optional query parameters (like page)
     *
     * @return PaginatedResponse The public keys response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}/public-keys
     */
    public function getAttachedPublicKeys(int $virtualMachineId, array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(
            sprintf('/api/vps/%s/virtual-machines/%d/public-keys', $version, $virtualMachineId),
            $query
        );

        /** @var PaginatedResponse */
        return $this->transform(PublicKey::class, $response);
    }
}
