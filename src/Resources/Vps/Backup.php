<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\Vps\Action as ActionData;
use DerrickOb\HostingerApi\Data\Vps\Backup as BackupData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Backups API.
 *
 * @link https://developers.hostinger.com/#tag/vps-backups
 */
final class Backup extends AbstractResource
{
    /**
     * Get backup list for a virtual machine.
     *
     * @param int           $virtualMachineId Virtual machine ID
     * @param array<string> $query            Optional query parameters (like page)
     *
     * @link https://developers.hostinger.com/#tag/vps-backups/GET/api/vps/v1/virtual-machines/{virtualMachineId}/backups
     *
     * @return PaginatedResponse The backups list
     *
     */
    public function list(int $virtualMachineId, array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/virtual-machines/%d/backups', $version, $virtualMachineId), $query);

        /** @var PaginatedResponse */
        return $this->transformResponse(BackupData::class, $response);
    }

    /**
     * Delete backup.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param int $backupId         Backup ID
     *
     * @link https://developers.hostinger.com/#tag/vps-backups/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId}
     *
     * @return array{message: string} Success response
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
     * @link https://developers.hostinger.com/#tag/vps-backups/POST/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId}/restore
     *
     * @return ActionData The initiated restore action
     *
     */
    public function restore(int $virtualMachineId, int $backupId): ActionData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/virtual-machines/%d/backups/%d/restore', $version, $virtualMachineId, $backupId));

        /** @var ActionData */
        return $this->transformResponse(ActionData::class, $response);
    }
}
