<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\DataCenter as DataCenterData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Data Centers API.
 *
 * @link https://developers.hostinger.com/#tag/vps-data-centers
 */
final class DataCenter extends Resource
{
    /**
     * Get data centers list.
     *
     * @return array<DataCenterData> List of data centers
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-data-centers/GET/api/vps/v1/data-centers
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/data-centers', $version));

        /** @var array<DataCenterData> */
        return $this->transform(DataCenterData::class, $response);
    }
}
