<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Domain;

use DerrickOb\HostingerApi\Data\Domain\Domain;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the Domains Portfolio API.
 *
 * @link https://developers.hostinger.com/#tag/domains-portfolio
 */
final class Portfolio extends AbstractResource
{
    /**
     * Get domain list.
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio/GET/api/domains/v1/portfolio
     *
     * @return array<Domain> List of domains in the portfolio
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/domains/%s/portfolio', $version));

        /** @var array<Domain> */
        return $this->transformResponse(Domain::class, $response);
    }
}
