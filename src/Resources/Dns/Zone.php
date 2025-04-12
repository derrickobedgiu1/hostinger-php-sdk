<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Dns;

use DerrickOb\HostingerApi\Data\Dns\Name;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the DNS Zones API.
 *
 * @link https://developers.hostinger.com/#tag/dns-zone
 */
final class Zone extends Resource
{
    /**
     * Get records for a domain.
     *
     * @param string $domain Domain name
     *
     * @return array<Name> List of DNS zone records
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/GET/api/dns/v1/zones/{domain}
     */
    public function getRecords(string $domain): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/dns/%s/zones/%s', $version, $domain));

        /** @var array<Name> */
        return $this->transform(Name::class, $response);
    }

    /**
     * Reset DNS zone to the default records.
     *
     * @param string $domain Domain name
     * @param array{
     *     sync?: bool,
     *     reset_email_records?: bool,
     *     whitelisted_record_types?: array<string>
     * } $data Optional reset parameters
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/POST/api/dns/v1/zones/{domain}/reset
     */
    public function reset(string $domain, array $data = []): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->post(sprintf('/api/dns/%s/zones/%s/reset', $version, $domain), $data);
    }
}
