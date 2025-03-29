<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a Catalog item in the Hostinger service Catalog.
 */
final class CatalogItem extends Data
{
    /** @var string Unique identifier for the catalog item. */
    public string $id;

    /** @var string Display name of the catalog item. */
    public string $name;

    /** @var string Category the item belongs to. */
    public string $category;

    /** @var array<int, CatalogItemPrice> Available pricing options for this catalog item. */
    public array $prices;

    /**
     * @param array{
     *      id: string,
     *      name: string,
     *      category: string,
     *      prices: array<int, array{
     *          id: string,
     *          name: string,
     *          currency: string,
     *          price: int,
     *          first_period_price: int,
     *          period: int,
     *          period_unit: string
     *      }>
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->category = $data['category'];
        $this->prices = array_map(
            fn (array $priceData): CatalogItemPrice => new CatalogItemPrice($priceData),
            $data['prices']
        );
    }
}
