<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Facades;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Resources\Domain\Availability;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;

/**
 * Facade for accessing Domain-related API resources.
 */
final class DomainFacade
{
    /**
     * @param ClientInterface $client The API client
     */
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Access the Portfolio resource.
     *
     * @link https://developers.hostinger.com/#tag/domains-portfolio
     *
     * @return Portfolio The portfolio resource instance
     */
    public function portfolio(): Portfolio
    {
        return new Portfolio($this->client);
    }

    /**
     * Access the Availability resource.
     *
     * @link https://developers.hostinger.com/#tag/domains-availability
     *
     * @return Availability The availability resource instance
     */
    public function availability(): Availability
    {
        return new Availability($this->client);
    }
}
