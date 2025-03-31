<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Order as OrderData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the Orders API.
 *
 * @link https://developers.hostinger.com/#tag/billing-orders
 */
final class Order extends AbstractResource
{
    /**
     * Create new service order.
     *
     * @param array{
     *     payment_method_id: int,
     *     items: array<int, array{
     *         item_id: string,
     *         quantity: int
     *     }>,
     *     coupons?: array<int, string>
     * } $data The order data with payment method, items, and optional coupons
     *
     * @return OrderData The created order
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-orders/POST/api/billing/v1/orders
     *
     */
    public function create(array $data): OrderData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/billing/%s/orders', $version), $data);

        /** @var OrderData */
        return $this->transformResponse(OrderData::class, $response);
    }
}
