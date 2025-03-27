<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

use DerrickOb\HostingerApi\HttpClient\GuzzleHttpClient;
use DerrickOb\HostingerApi\HttpClient\HttpClientInterface;

final class Client implements ClientInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(private Config $config, ?HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new GuzzleHttpClient($this->config);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $path, array $query = []): array
    {
        $options = $query === [] ? [] : ['query' => $query];

        return $this->httpClient->request('GET', $path, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $path, array $data = []): array
    {
        return $this->httpClient->request('POST', $path, ['json' => $data]);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $path, array $data = []): array
    {
        return $this->httpClient->request('PUT', $path, ['json' => $data]);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $path): array
    {
        return $this->httpClient->request('DELETE', $path);
    }

    /**
     * {@inheritdoc}
     */
    public function getApiVersion(): string
    {
        return $this->config->getApiVersion();
    }
}
