<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Facades;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Resources\Billing\Catalog;
use DerrickOb\HostingerApi\Resources\Billing\Order;
use DerrickOb\HostingerApi\Resources\Billing\PaymentMethod;
use DerrickOb\HostingerApi\Resources\Billing\Subscription;

/**
 * Facade for accessing Billing-related API resources.
 */
final class BillingFacade
{
    /**
     * @param ClientInterface $client The API client
     */
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Access the Catalog resource.
     *
     * @link https://developers.hostinger.com/#tag/billing-catalog
     *
     * @return Catalog The catalog resource instance
     */
    public function catalog(): Catalog
    {
        return new Catalog($this->client);
    }

    /**
     * Access the Order resource.
     *
     * @link https://developers.hostinger.com/#tag/billing-orders
     *
     * @return Order The order resource instance
     */
    public function orders(): Order
    {
        return new Order($this->client);
    }

    /**
     * Access the PaymentMethod resource.
     *
     * @link https://developers.hostinger.com/#tag/billing-payment-methods
     *
     * @return PaymentMethod The payment method resource instance
     */
    public function paymentMethods(): PaymentMethod
    {
        return new PaymentMethod($this->client);
    }

    /**
     * Access the Subscription resource.
     *
     * @link https://developers.hostinger.com/#tag/billing-subscriptions
     *
     * @return Subscription The subscription resource instance
     */
    public function subscriptions(): Subscription
    {
        return new Subscription($this->client);
    }
}
