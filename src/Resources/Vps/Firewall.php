<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\Firewall as FirewallData;
use DerrickOb\HostingerApi\Data\Vps\FirewallRule;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Firewalls API.
 *
 * @link https://developers.hostinger.com/#tag/vps-firewall
 */
final class Firewall extends Resource
{
    /**
     * Get firewall list.
     *
     * @param array<string> $query Optional query parameters (like page)
     *
     * @return PaginatedResponse The firewalls list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/GET/api/vps/v1/firewall
     *
     */
    public function list(array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/firewall', $version), $query);

        /** @var PaginatedResponse */
        return $this->transformResponse(FirewallData::class, $response);
    }

    /**
     * Get firewall details.
     *
     * @param int $firewallId Firewall ID
     *
     * @return FirewallData The firewall details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/GET/api/vps/v1/firewall/{firewallId}
     *
     */
    public function get(int $firewallId): FirewallData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/firewall/%d', $version, $firewallId));

        /** @var FirewallData */
        return $this->transformResponse(FirewallData::class, $response);
    }

    /**
     * Create new firewall.
     *
     * @param array{
     *     name: string
     * } $data Firewall creation data
     *
     * @return FirewallData The created firewall
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall
     *
     */
    public function create(array $data): FirewallData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/firewall', $version), $data);

        /** @var FirewallData */
        return $this->transformResponse(FirewallData::class, $response);
    }

    /**
     * Delete firewall.
     *
     * @param int $firewallId Firewall ID
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/DELETE/api/vps/v1/firewall/{firewallId}
     *
     */
    public function delete(int $firewallId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->delete(sprintf('/api/vps/%s/firewall/%d', $version, $firewallId));
    }

    /**
     * Create firewall rule.
     *
     * @param int $firewallId Firewall ID
     * @param array{
     *     protocol: string,
     *     port: string,
     *     source: string,
     *     source_detail: string
     * } $data Rule creation data
     *
     * @return FirewallRule The created rule
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/rules
     *
     */
    public function createRule(int $firewallId, array $data): FirewallRule
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/firewall/%d/rules', $version, $firewallId), $data);

        /** @var FirewallRule */
        return $this->transformResponse(FirewallRule::class, $response);
    }

    /**
     * Update firewall rule.
     *
     * @param int $firewallId     Firewall ID
     * @param int $firewallRuleId Rule ID
     * @param array{
     *     protocol: string,
     *     port: string,
     *     source: string,
     *     source_detail: string
     * } $data Rule update data
     *
     * @return FirewallRule The updated rule
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/PUT/api/vps/v1/firewall/{firewallId}/rules/{ruleId}
     *
     */
    public function updateRule(int $firewallId, int $firewallRuleId, array $data): FirewallRule
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/firewall/%d/rules/%d', $version, $firewallId, $firewallRuleId), $data);

        /** @var FirewallRule */
        return $this->transformResponse(FirewallRule::class, $response);
    }

    /**
     * Delete firewall rule.
     *
     * @param int $firewallId     Firewall ID
     * @param int $firewallRuleId Rule ID
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/DELETE/api/vps/v1/firewall/{firewallId}/rules/{ruleId}
     *
     */
    public function deleteRule(int $firewallId, int $firewallRuleId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->delete(sprintf('/api/vps/%s/firewall/%d/rules/%d', $version, $firewallId, $firewallRuleId));
    }

    /**
     * Activate firewall for a virtual machine.
     *
     * @param int $firewallId       Firewall ID
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action The initiated activation action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/activate/{virtualMachineId}
     *
     */
    public function activate(int $firewallId, int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/firewall/%d/activate/%d', $version, $firewallId, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Deactivate firewall for a virtual machine.
     *
     * @param int $firewallId       Firewall ID
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return Action Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/deactivate/{virtualMachineId}
     *
     */
    public function deactivate(int $firewallId, int $virtualMachineId): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/firewall/%d/deactivate/%d', $version, $firewallId, $virtualMachineId));

        /** @var Action */
        return $this->transformResponse(Action::class, $response);
    }

    /**
     * Sync firewall with a virtual machine.
     *
     * @param int $firewallId       Firewall ID
     * @param int $virtualMachineId Virtual machine ID
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/sync/{virtualMachineId}
     */
    public function sync(int $firewallId, int $virtualMachineId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->post(sprintf('/api/vps/%s/firewall/%d/sync/%d', $version, $firewallId, $virtualMachineId));
    }
}
