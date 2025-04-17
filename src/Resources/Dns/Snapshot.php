<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Dns;

use DerrickOb\HostingerApi\Data\Dns\Snapshot as SnapshotData;
use DerrickOb\HostingerApi\Data\Dns\SnapshotWithContent;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the DNS Snapshots API.
 *
 * @link https://developers.hostinger.com/#tag/dns-snapshot
 */
final class Snapshot extends Resource
{
    /**
     * Get snapshot list for a domain.
     *
     * @param string $domain Domain name
     *
     * @return array<SnapshotData> The snapshots list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-snapshot/GET/api/dns/v1/snapshots/{domain}
     */
    public function list(string $domain): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/dns/%s/snapshots/%s', $version, $domain));

        /** @var array<SnapshotData> */
        return $this->transform(SnapshotData::class, $response);
    }

    /**
     * Get a specific snapshot with content.
     *
     * @param string $domain     Domain name
     * @param int    $snapshotId Snapshot ID
     *
     * @return SnapshotWithContent The snapshot details with content
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-snapshot/GET/api/dns/v1/snapshots/{domain}/{snapshotId}
     */
    public function get(string $domain, int $snapshotId): SnapshotWithContent
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/dns/%s/snapshots/%s/%d', $version, $domain, $snapshotId));

        /** @var SnapshotWithContent */
        return $this->transform(SnapshotWithContent::class, $response);
    }

    /**
     * Restore DNS zone to a selected snapshot.
     *
     * @param string $domain     Domain name
     * @param int    $snapshotId Snapshot ID
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-snapshot/POST/api/dns/v1/snapshots/{domain}/{snapshotId}
     */
    public function restore(string $domain, int $snapshotId): SuccessResponse
    {
        $version = $this->getApiVersion();

        $response = $this->client->post(sprintf('/api/dns/%s/snapshots/%s/%d/restore', $version, $domain, $snapshotId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
