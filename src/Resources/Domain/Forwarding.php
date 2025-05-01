<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Forwarding as ForwardingData;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Domains Forwarding API.
 *
 * @link https://developers.hostinger.com/#tag/domains-forwarding
 */
final class Forwarding extends Resource
{
    /**
     * Get forwarding data for a domain.
     *
     * @param string $domain Domain name
     *
     * @return ForwardingData The forwarding data
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-forwarding/GET/api/domains/v1/forwarding/{domain}
     */
    public function get(string $domain): ForwardingData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/forwarding/%s', $version, $domain));

        /** @var ForwardingData */
        return $this->transform(ForwardingData::class, $response);
    }

    /**
     * Create forwarding data for a domain.
     *
     * @param array{
     *     domain: string,
     *     redirect_type: string,
     *     redirect_url: string
     * } $data Forwarding creation data
     *
     * @return ForwardingData The created forwarding data
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-forwarding/POST/api/domains/v1/forwarding
     */
    public function create(array $data): ForwardingData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/domains/%s/forwarding', $version), $data);

        /** @var ForwardingData */
        return $this->transform(ForwardingData::class, $response);
    }

    /**
     * Delete forwarding data for a domain.
     *
     * @param string $domain Domain name
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-forwarding/DELETE/api/domains/v1/forwarding/{domain}
     */
    public function delete(string $domain): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/domains/%s/forwarding/%s', $version, $domain));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
