<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\CatalogItem;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Catalog API.
 *
 * @link https://developers.hostinger.com/#tag/billing-catalog
 */
final class Catalog extends Resource
{
    /**
     * Get catalog item list.
     *
     * Retrieves a list of all available catalog items with their pricing options.
     * Can be filtered by category and name.
     *
     * @param array{
     *     category?: string,
     *     name?: string
     * } $query Optional query parameters to filter the list.
     *              - `category`: Filter by category (e.g., 'DOMAIN', 'VPS').
     *              - `name`: Filter by name (use `*` for wildcard, e.g., '.COM*').
     *
     * @return array<CatalogItem> List of catalog items
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-catalog/GET/api/billing/v1/catalog
     */
    public function list(array $query = []): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/catalog', $version), $query);

        /** @var array<CatalogItem> */
        return $this->transform(CatalogItem::class, $response);
    }
}
