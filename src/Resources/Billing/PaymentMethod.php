<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\PaymentMethod as PaymentMethodData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the Payment Methods API.
 *
 * @link https://developers.hostinger.com/#tag/billing-payment-methods
 */
final class PaymentMethod extends AbstractResource
{
    /**
     * Get payment method list.
     *
     * @link https://developers.hostinger.com/#tag/billing-payment-methods/GET/api/billing/v1/payment-methods
     *
     * @return array<PaymentMethodData> The payment methods
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/payment-methods', $version));

        /** @var array<PaymentMethodData> */
        return $this->transformResponse(PaymentMethodData::class, $response);
    }

    /**
     * Set default payment method.
     *
     * @param int $paymentMethodId ID of the payment method to set as default
     *
     * @return array{message: string} Success response
     *
     */
    public function setDefault(int $paymentMethodId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->post(sprintf('/api/billing/%s/payment-methods/%d', $version, $paymentMethodId));
    }

    /**
     * Delete payment method.
     *
     * @param int $paymentMethodId ID of the payment method to delete
     *
     * @return array{message: string} Success response
     *
     */
    public function delete(int $paymentMethodId): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->delete(sprintf('/api/billing/%s/payment-methods/%d', $version, $paymentMethodId));
    }
}
