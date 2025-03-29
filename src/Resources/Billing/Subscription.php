<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Billing;

use DerrickOb\HostingerApi\Data\Billing\Subscription as SubscriptionData;
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
     * @link https://developers.hostinger.com/#tag/billing-subscriptions/GET/api/billing/v1/subscriptions
     *
     * @return array<SubscriptionData> The subscriptions
     *
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/billing/%s/subscriptions', $version));

        /** @var array<SubscriptionData> */
        return $this->transformResponse(SubscriptionData::class, $response);
    }
}
