<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Order as OrderData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Orders API.
 *
 * @link https://developers.hostinger.com/#tag/billing-orders
 */
final class Order extends Resource
{
    /**
     * Create new service order.
     *
     * To place order, you need to provide payment method ID and list of price items
     * from the catalog endpoint together with quantity.
     * Coupons also can be provided during order creation.
     * Orders created using this endpoint will be set for automatic renewal.
     * Some `credit_card` payments might need additional verification, rendering purchase unprocessed.
     * We recommend use other payment methods than `credit_card` if you encounter this issue.
     *
     * @param array{
     *     payment_method_id: int,
     *     items: array<int, array{
     *         item_id: string,
     *         quantity: int
     *     }>,
     *     coupons?: array<int, string>
     * } $data The order data with payment method, items, and optional discount coupon codes.
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
        return $this->transform(OrderData::class, $response);
    }
}
