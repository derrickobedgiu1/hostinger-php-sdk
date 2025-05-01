<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\WhoisProfile;
use DerrickOb\HostingerApi\Data\Domain\WhoisProfileUsage;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Domains WHOIS API.
 *
 * @link https://developers.hostinger.com/#tag/domains-whois
 */
final class Whois extends Resource
{
    /**
     * Get WHOIS profile list.
     *
     * @param array{tld?: string} $query Optional query parameters. Filter by TLD (without leading dot).
     *
     * @return array<WhoisProfile> List of WHOIS profiles
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois
     */
    public function list(array $query = []): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/whois', $version), $query);

        /** @var array<WhoisProfile> */
        return $this->transform(WhoisProfile::class, $response);
    }

    /**
     * Create WHOIS profile.
     *
     * @param array{
     *     tld: string,
     *     entity_type: string,
     *     country: string,
     *     whois_details: array<string, mixed>,
     *     tld_details?: array<string, mixed>
     * } $data WHOIS profile creation data. `tld` should be without the leading dot.
     *
     * @return WhoisProfile The created WHOIS profile
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-whois/POST/api/domains/v1/whois
     */
    public function create(array $data): WhoisProfile
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/domains/%s/whois', $version), $data);

        /** @var WhoisProfile */
        return $this->transform(WhoisProfile::class, $response);
    }

    /**
     * Get WHOIS profile.
     *
     * @param int $whoisId WHOIS profile ID
     *
     * @return WhoisProfile The WHOIS profile details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois/{whoisId}
     */
    public function get(int $whoisId): WhoisProfile
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/whois/%d', $version, $whoisId));

        /** @var WhoisProfile */
        return $this->transform(WhoisProfile::class, $response);
    }

    /**
     * Delete WHOIS profile.
     *
     * @param int $whoisId WHOIS profile ID
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-whois/DELETE/api/domains/v1/whois/{whoisId}
     */
    public function delete(int $whoisId): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/domains/%s/whois/%d', $version, $whoisId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Get WHOIS profile usage.
     *
     * @param int $whoisId WHOIS profile ID
     *
     * @return WhoisProfileUsage List of domains using the profile
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois/{whoisId}/usage
     */
    public function getUsage(int $whoisId): WhoisProfileUsage
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/whois/%d/usage', $version, $whoisId));

        return new WhoisProfileUsage($response);
    }
}
