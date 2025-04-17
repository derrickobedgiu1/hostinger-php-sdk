<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Dns;

use DerrickOb\HostingerApi\Data\Dns\Name;
use DerrickOb\HostingerApi\Data\SuccessResponse;
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
     * Update zone records.
     *
     * Updates DNS records for the selected domain.
     * Using `overwrite = true` will replace existing records with the provided ones.
     * Otherwise existing records will be updated and new records will be added.
     *
     * @param string $domain Domain name
     * @param array{
     *      overwrite?: bool,
     *      zone: array<int, array{
     *          name: string,
     *          records: array<int, array{content: string}>,
     *          ttl?: int,
     *          type: string
     *      }>
     *  } $data DNS records data
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/PUT/api/dns/v1/zones/{domain}
     */
    public function update(string $domain, array $data): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/dns/%s/zones/%s', $version, $domain), $data);

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Delete zone records.
     *
     * Deletes specific DNS records based on the provided filters (name and type).
     *
     * @param string $domain Domain name
     * @param array{
     *      filters: array<int, array{
     *          name: string,
     *          type: string
     *      }>
     *  } $data Filters for records to delete
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/DELETE/api/dns/v1/zones/{domain}
     */
    public function delete(string $domain, array $data): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/dns/%s/zones/%s', $version, $domain), $data);

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Validate zone records before updating.
     *
     * If the validation is successful, the response will contain `200 Success` code.
     * If there is validation error, the response will fail with `422 Validation error` code.
     *
     * @param string $domain Domain name
     * @param array{
     *      overwrite?: bool,
     *      zone: array<int, array{
     *          name: string,
     *          records: array<int, array{content: string}>,
     *          ttl?: int,
     *          type: string
     *      }>
     *  } $data DNS records data to validate
     *
     * @return SuccessResponse Success response if validation passes
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/POST/api/dns/v1/zones/{domain}/validate
     */
    public function validate(string $domain, array $data): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/dns/%s/zones/%s/validate', $version, $domain), $data);

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
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
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/dns-zone/POST/api/dns/v1/zones/{domain}/reset
     */
    public function reset(string $domain, array $data = []): SuccessResponse
    {
        $version = $this->getApiVersion();

        $response = $this->client->post(sprintf('/api/dns/%s/zones/%s/reset', $version, $domain), $data);

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
