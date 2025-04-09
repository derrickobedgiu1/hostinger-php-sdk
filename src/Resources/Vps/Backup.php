<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\Backup as BackupData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Backups API.
 *
 * @link https://developers.hostinger.com/#tag/vps-backups
 */
final class Backup extends Resource
{
    /**
     * Get backup list for a virtual machine.
     *
     * @param int           $virtualMachineId Virtual machine ID
     * @param array<string> $query            Optional query parameters (like page)
     *
     * @return PaginatedResponse The backups list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-backups/GET/api/vps/v1/virtual-machines/{virtualMachineId}/backups
     *
     */
    public function list(int $virtualMachineId, array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/backups', $version, $virtualMachineId), $query);

        /** @var PaginatedResponse */
        return $this->transform(BackupData::class, $response);
    }

    /**
     * Delete backup.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param int $backupId         Backup ID
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-backups/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId}
     *
     */
    public function delete(int $virtualMachineId, int $backupId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->delete(sprintf('/api/vps/%s/virtual-machines/%d/backups/%d', $version, $virtualMachineId, $backupId));
    }

    /**
     * Restore backup.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param int $backupId         Backup ID
     *
     * @return ActionData The initiated restore action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-backups/POST/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId}/restore
     *
     */
    public function restore(int $virtualMachineId, int $backupId): ActionData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/backups/%d/restore', $version, $virtualMachineId, $backupId));

        /** @var ActionData */
        return $this->transform(ActionData::class, $response);
    }
}
