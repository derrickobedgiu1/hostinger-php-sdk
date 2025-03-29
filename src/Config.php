<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

/**
 * Configuration for the Hostinger API client.
 */
final class Config
{
    /** @var string Base URL for the API. */
    private readonly string $baseUrl;

    /** @var int Request timeout in seconds. */
    private readonly int $timeout;

    /** @var string API version. */
    private readonly string $apiVersion;

    /**
     * @param string $apiToken API token for authentication
     * @param array{
     *      base_url?: string,
     *      timeout?: int,
     *      api_version?: string
     *  }  $options  Configuration options
     */
    public function __construct(private readonly string $apiToken, array $options = [])
    {
        $this->baseUrl = $options['base_url'] ?? 'https://developers.hostinger.com';
        $this->timeout = $options['timeout'] ?? 30;
        $this->apiVersion = $options['api_version'] ?? 'v1';
    }

    /**
     * Get the API token.
     *
     * @return string The API token
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * Get the base URL.
     *
     * @return string The base URL
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the timeout.
     *
     * @return int The timeout in seconds
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Get the API version.
     *
     * @return string The API version
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }
}
