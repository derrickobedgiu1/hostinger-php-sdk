<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi;

interface ClientInterface
{
    /**
     * Send a GET request
     *
     * @param string $path  The endpoint path
     * @param array  $query Optional query parameters
     *
     * @return array The response data
     */
    public function get(string $path, array $query = []): array;

    /**
     * Send a POST request
     *
     * @param string $path The endpoint path
     * @param array  $data Request data
     *
     * @return array The response data
     */
    public function post(string $path, array $data = []): array;

    /**
     * Send a PUT request
     *
     * @param string $path The endpoint path
     * @param array  $data Request data
     *
     * @return array The response data
     */
    public function put(string $path, array $data = []): array;

    /**
     * Send a DELETE request
     *
     * @param string $path The endpoint path
     *
     * @return array The response data
     */
    public function delete(string $path): array;

    /**
     * Get the API version
     */
    public function getApiVersion(): string;
}
