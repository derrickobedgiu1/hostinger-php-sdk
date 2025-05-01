<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Billing\Order as OrderData;
use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Data\Domain\DomainExtended;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Domains Portfolio API.
 *
 * @link https://developers.hostinger.com/#tag/domains-portfolio
 */
final class Portfolio extends Resource
{
    /**
     * Get domain list.
     *
     * @return array<Domain> List of domains in the portfolio
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/GET/api/domains/v1/portfolio
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/portfolio', $version));

        /** @var array<Domain> */
        return $this->transform(Domain::class, $response);
    }

    /**
     * Get extended details for a specific domain.
     *
     * @param string $domain Domain name
     *
     * @return DomainExtended The extended domain details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/GET/api/domains/v1/portfolio/{domain}
     */
    public function get(string $domain): DomainExtended
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/portfolio/%s', $version, $domain));

        /** @var DomainExtended */
        return $this->transform(DomainExtended::class, $response);
    }

    /**
     * Purchase new domain.
     *
     * Allows you to buy (purchase) and register a new domain name.
     * If no payment method is provided, your default payment method will be used.
     * If no WHOIS information is provided, the default contact information for that TLD will be used.
     * Some TLDs require `additional_details`.
     *
     * @param array{
     *     domain: string,
     *     item_id: string,
     *     payment_method_id?: int,
     *     domain_contacts?: array{
     *         owner_id?: int,
     *         admin_id?: int,
     *         billing_id?: int,
     *         tech_id?: int
     *     },
     *     additional_details?: array<string, mixed>,
     *     coupons?: array<int, string>
     * } $data Domain purchase data
     *
     * @return OrderData The resulting order details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/POST/api/domains/v1/portfolio
     */
    public function purchase(array $data): OrderData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/domains/%s/portfolio', $version), $data);

        /** @var OrderData */
        return $this->transform(OrderData::class, $response);
    }

    /**
     * Enable domain lock for a domain.
     *
     * @param string $domain Domain name
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/domain-lock
     */
    public function enableDomainLock(string $domain): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/domains/%s/portfolio/%s/domain-lock', $version, $domain));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Disable domain lock for a domain.
     *
     * @param string $domain Domain name
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/DELETE/api/domains/v1/portfolio/{domain}/domain-lock
     */
    public function disableDomainLock(string $domain): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/domains/%s/portfolio/%s/domain-lock', $version, $domain));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Enable privacy protection for a domain.
     *
     * @param string $domain Domain name
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/privacy-protection
     */
    public function enablePrivacyProtection(string $domain): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/domains/%s/portfolio/%s/privacy-protection', $version, $domain));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Disable privacy protection for a domain.
     *
     * @param string $domain Domain name
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/DELETE/api/domains/v1/portfolio/{domain}/privacy-protection
     */
    public function disablePrivacyProtection(string $domain): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/domains/%s/portfolio/%s/privacy-protection', $version, $domain));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Update nameservers for a domain.
     *
     * @param string $domain Domain name
     * @param array{
     *     ns1: string,
     *     ns2: string,
     *     ns3?: string,
     *     ns4?: string
     * } $data Nameserver data
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/nameservers
     */
    public function updateNameservers(string $domain, array $data): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/domains/%s/portfolio/%s/nameservers', $version, $domain), $data);

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
