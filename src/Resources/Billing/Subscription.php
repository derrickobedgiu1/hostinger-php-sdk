<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Subscription as SubscriptionData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the Subscriptions API.
 *
 * @link https://developers.hostinger.com/#tag/billing-subscriptions
 */
final class Subscription extends Resource
{
    /**
     * Get subscription list.
     *
     * @return array<SubscriptionData> The subscriptions
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-subscriptions/GET/api/billing/v1/subscriptions
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/subscriptions', $version));

        /** @var array<SubscriptionData> */
        return $this->transform(SubscriptionData::class, $response);
    }

    /**
     * Cancel subscription.
     *
     * @param string $subscriptionId Subscription ID
     * @param array{
     *     reason_code?: string|null,
     *     cancel_option?: string|null
     * } $data Optional cancellation data with reason code and cancel option
     *
     * @return array{message: string} Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/billing-subscriptions/DELETE/api/billing/v1/subscriptions/{subscriptionId}
     */
    public function cancel(string $subscriptionId, array $data = []): array
    {
        $version = $this->getApiVersion();

        /** @var array{message: string} */
        return $this->client->delete(sprintf('/api/billing/%s/subscriptions/%s', $version, $subscriptionId), $data);
    }
}
