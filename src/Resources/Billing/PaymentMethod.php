<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\PaymentMethod as PaymentMethodData;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Payment Methods API.
 *
 * @link https://developers.hostinger.com/#tag/billing-payment-methods
 */
final class PaymentMethod extends Resource
{
    /**
     * Get payment method list.
     *
     * @return array<PaymentMethodData> The payment methods
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-payment-methods/GET/api/billing/v1/payment-methods
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/payment-methods', $version));

        /** @var array<PaymentMethodData> */
        return $this->transform(PaymentMethodData::class, $response);
    }

    /**
     * Set default payment method.
     *
     * @param int $paymentMethodId ID of the payment method to set as default
     *
     * @return SuccessResponse Success response
     *
     * @throws ApiException            For other API errors
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     *
     * @link https://developers.hostinger.com/#tag/billing-payment-methods/POST/api/billing/v1/payment-methods/{paymentMethodId}
     */
    public function setDefault(int $paymentMethodId): SuccessResponse
    {
        $version = $this->getApiVersion();

        $response = $this->client->post(sprintf('/api/billing/%s/payment-methods/%d', $version, $paymentMethodId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Delete payment method.
     *
     * @param int $paymentMethodId ID of the payment method to delete
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-payment-methods/DELETE/api/billing/v1/payment-methods/{paymentMethodId}
     *
     */
    public function delete(int $paymentMethodId): SuccessResponse
    {
        $version = $this->getApiVersion();

        $response = $this->client->delete(sprintf('/api/billing/%s/payment-methods/%d', $version, $paymentMethodId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
