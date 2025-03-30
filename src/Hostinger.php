<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

use DerrickOb\HostingerApi\Facades\BillingFacade;
use DerrickOb\HostingerApi\Facades\DomainFacade;
use DerrickOb\HostingerApi\Facades\VpsFacade;
use DerrickOb\HostingerApi\HttpClient\HttpClientInterface;

final class Hostinger
{
    /** @var ClientInterface The API client instance. */
    private readonly ClientInterface $client;

    /**
     * @param string $apiToken API token
     * @param array{
     *      base_url?: string,
     *      timeout?: int,
     *      api_version?: string
     *  } $options    Configuration options
     * @param HttpClientInterface|null $httpClient Optional custom HTTP client
     */
    public function __construct(
        string $apiToken,
        array $options = [],
        ?HttpClientInterface $httpClient = null
    ) {
        $config = new Config($apiToken, $options);
        $this->client = new Client($config, $httpClient);
    }

    /**
     * Get the API client instance.
     *
     * @return ClientInterface The client instance
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Access the Billing facade.
     *
     * @return BillingFacade The billing facade
     */
    public function billing(): BillingFacade
    {
        return new BillingFacade($this->client);
    }

    /**
     * Access the Domain facade.
     *
     * @return DomainFacade The domain facade
     */
    public function domains(): DomainFacade
    {
        return new DomainFacade($this->client);
    }

    /**
     * Access the VPS facade.
     *
     * @return VpsFacade The VPS facade
     */
    public function vps(): VpsFacade
    {
        return new VpsFacade($this->client);
    }
}
