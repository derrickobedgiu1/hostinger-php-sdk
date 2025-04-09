<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
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
}
