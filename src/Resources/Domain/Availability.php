<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Availability as AvailabilityData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Domains Availability API.
 *
 * @link https://developers.hostinger.com/#tag/domains-availability
 */
final class Availability extends Resource
{
    /**
     * Check domain availability.
     *
     * Checks the availability of a domain name across multiple TLDs.
     *
     * @param array{
     *     domain: string,
     *     tlds: array<int, string>,
     *     with_alternatives?: bool
     * } $data Domain name and TLDs to check
     *
     * @return array<AvailabilityData> List of availability results
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-availability/POST/api/domains/v1/availability
     */
    public function check(array $data): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/domains/%s/availability', $version), $data);

        /** @var array<AvailabilityData> */
        return $this->transform(AvailabilityData::class, $response);
    }
}
