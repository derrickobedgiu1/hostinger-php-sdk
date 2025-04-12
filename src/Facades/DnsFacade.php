<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Facades;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Resources\Dns\Snapshot;
use DerrickOb\HostingerApi\Resources\Dns\Zone;

/**
 * Facade for accessing DNS-related API resources.
 */
final class DnsFacade
{
    /**
     * @param ClientInterface $client The API client
     */
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Access the Snapshot resource.
     *
     * @link https://developers.hostinger.com/#tag/dns-snapshot
     *
     * @return Snapshot The snapshot resource instance
     */
    public function snapshots(): Snapshot
    {
        return new Snapshot($this->client);
    }

    /**
     * Access the Zone resource.
     *
     * @link https://developers.hostinger.com/#tag/dns-zone
     *
     * @return Zone The zone resource instance
     */
    public function zones(): Zone
    {
        return new Zone($this->client);
    }
}
