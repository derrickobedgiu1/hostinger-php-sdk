<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\DataCenter as DataCenterData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS Data Centers API.
 *
 * @link https://developers.hostinger.com/#tag/vps-data-centers
 */
final class DataCenter extends AbstractResource
{
    /**
     * Get data centers list.
     *
     * @link https://developers.hostinger.com/#tag/vps-data-centers/GET/api/vps/v1/data-centers
     *
     * @return array<DataCenterData> List of data centers
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/data-centers', $version));

        /** @var array<DataCenterData> */
        return $this->transformResponse(DataCenterData::class, $response);
    }
}
