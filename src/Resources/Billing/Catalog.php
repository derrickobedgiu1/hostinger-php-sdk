<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\CatalogItem;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the Catalog API.
 *
 * @link https://developers.hostinger.com/#tag/billing-catalog
 */
final class Catalog extends AbstractResource
{
    /**
     * Get catalog item list.
     *
     * Retrieves a list of all available catalog items with their pricing options.
     *
     * @link https://developers.hostinger.com/#tag/billing-catalog/GET/api/billing/v1/catalog
     *
     * @return array<CatalogItem> List of catalog items
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/catalog', $version));

        /** @var array<CatalogItem> */
        return $this->transformResponse(CatalogItem::class, $response);
    }
}
