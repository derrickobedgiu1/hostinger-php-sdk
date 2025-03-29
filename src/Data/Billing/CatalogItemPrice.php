<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\PeriodUnit;

/**
 * Represents a Price option for a Catalog item.
 */
final class CatalogItemPrice extends Data
{
    /** @var string Unique identifier for the price item. */
    public string $id;

    /** @var string Display name for this price option. */
    public string $name;

    /** @var string Currency code for the price */
    public string $currency;

    /** @var int Regular price in cents. */
    public int $price;

    /** @var int First period promotional price in cents. */
    public int $first_period_price;

    /** @var int Billing period length. */
    public int $period;

    /** @var PeriodUnit Billing period unit (month, year). */
    public PeriodUnit $period_unit;

    /**
     * @param array{
     *      id: string,
     *      name: string,
     *      currency: string,
     *      price: int,
     *      first_period_price: int,
     *      period: int,
     *      period_unit: string,
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->currency = $data['currency'];
        $this->price = $data['price'];
        $this->first_period_price = $data['first_period_price'];
        $this->period = $data['period'];
        $this->period_unit = PeriodUnit::from($data['period_unit']);
    }
}
