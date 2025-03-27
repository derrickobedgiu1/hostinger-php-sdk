<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

final class Config
{
    /**
     * Base URL for the API
     */
    private string $baseUrl;

    /**
     * Request timeout in seconds
     */
    private int $timeout;

    /**
     * API version
     */
    private string $apiVersion;

    /**
     * @param string $apiToken API token for authentication
     * @param array  $options  Configuration options
     */
    public function __construct(private string $apiToken, array $options = [])
    {
        $this->baseUrl = $options['base_url'] ?? 'https://developers.hostinger.com';
        $this->timeout = $options['timeout'] ?? 30;
        $this->apiVersion = $options['api_version'] ?? 'v1';
    }

    /**
     * Get the API token
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * Get the base URL
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the timeout
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Get the API version
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }
}
