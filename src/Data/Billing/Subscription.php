<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\PeriodUnit;
use DerrickOb\HostingerApi\Enums\SubscriptionStatus;
use Exception;

/**
 * Represents a Subscription in the Hostinger Billing System.
 */
final class Subscription extends Data
{
    /** @var string Unique identifier for the subscription. */
    public string $id;

    /** @var string Display name of the subscription. */
    public string $name;

    /** @var SubscriptionStatus Current status of the subscription. */
    public SubscriptionStatus $status;

    /** @var int Length of the billing period. */
    public int $billing_period;

    /** @var PeriodUnit Unit of the billing period (month, year). */
    public PeriodUnit $billing_period_unit;

    /** @var string Currency code for the subscription prices. */
    public string $currency_code;

    /** @var int Total price in cents. */
    public int $total_price;

    /** @var int Renewal price in cents. */
    public int $renewal_price;

    /** @var bool Whether the subscription will automatically renew. */
    public bool $auto_renew;

    /** @var DateTimeImmutable Date and time when the subscription was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable|null Date and time when the subscription expires. */
    public ?DateTimeImmutable $expires_at;

    /** @var DateTimeImmutable|null Date and time of the next billing. */
    public ?DateTimeImmutable $next_billing_at;

    /**
     * @param array{
     *      id: string,
     *      name: string,
     *      status: string,
     *      billing_period: int,
     *      billing_period_unit: string,
     *      currency_code: string,
     *      total_price: int,
     *      renewal_price: int,
     *      auto_renew: bool,
     *      created_at: string,
     *      expires_at?: string|null,
     *      next_billing_at?: string|null
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->status = SubscriptionStatus::from($data['status']);
        $this->billing_period = $data['billing_period'];
        $this->billing_period_unit = PeriodUnit::from($data['billing_period_unit']);
        $this->currency_code = $data['currency_code'];
        $this->total_price = $data['total_price'];
        $this->renewal_price = $data['renewal_price'];
        $this->auto_renew = $data['auto_renew'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->expires_at = isset($data['expires_at']) ? new DateTimeImmutable($data['expires_at']) : null;
        $this->next_billing_at = isset($data['next_billing_at']) ? new DateTimeImmutable($data['next_billing_at']) : null;
    }
}
