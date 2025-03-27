<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\HttpClient;

interface HttpClientInterface
{
    /**
     * Send a request to the API
     *
     * @param string $method  HTTP method
     * @param string $uri     URI
     * @param array  $options Request options
     *
     * @return array Response data
     */
    public function request(string $method, string $uri, array $options = []): array;
}
