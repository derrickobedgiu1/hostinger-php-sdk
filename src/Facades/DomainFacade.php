<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Facades;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Resources\Domain\Availability;
use DerrickOb\HostingerApi\Resources\Domain\Forwarding;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;
use DerrickOb\HostingerApi\Resources\Domain\Whois;

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

    /**
     * Access the Forwarding resource.
     *
     * @link https://developers.hostinger.com/#tag/domains-forwarding
     *
     * @return Forwarding The forwarding resource instance
     */
    public function forwarding(): Forwarding
    {
        return new Forwarding($this->client);
    }

    /**
     * Access the WHOIS resource.
     *
     * @link https://developers.hostinger.com/#tag/domains-whois
     *
     * @return Whois The WHOIS resource instance
     */
    public function whois(): Whois
    {
        return new Whois($this->client);
    }
}
