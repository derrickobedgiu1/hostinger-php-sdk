<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Subscription as SubscriptionData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the Subscriptions API.
 *
 * @link https://developers.hostinger.com/#tag/billing-subscriptions
 */
final class Subscription extends AbstractResource
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
        return $this->transformResponse(SubscriptionData::class, $response);
    }
}
