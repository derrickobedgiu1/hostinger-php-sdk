<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\OrderStatus;
use Exception;

/**
 * Represents an Order in the Hostinger billing System.
 */
final class Order extends Data
{
    /** @var int Unique identifier for the order. */
    public int $id;

    /** @var string|null Subscription ID associated with this order. */
    public ?string $subscription_id;

    /** @var OrderStatus Current status of the order. */
    public OrderStatus $status;

    /** @var string Currency code for the order prices. */
    public string $currency;

    /** @var int Subtotal amount in cents (excluding taxes). */
    public int $subtotal;

    /** @var int Total amount in cents (including taxes). */
    public int $total;

    /** @var BillingAddress Billing address associated with this order. */
    public BillingAddress $billing_address;

    /** @var DateTimeImmutable Date and time when the order was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the order was last updated. */
    public DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      id: int,
     *      subscription_id?: string,
     *      status: string,
     *      currency: string,
     *      subtotal: int,
     *      total: int,
     *      billing_address: array{
     *          first_name: string,
     *          last_name: string,
     *          company?: string|null,
     *          address_1?: string|null,
     *          address_2?: string|null,
     *          city?: string|null,
     *          state?: string|null,
     *          zip?: string|null,
     *          country?: string|null,
     *          phone?: string|null,
     *          email: string
     *      },
     *      created_at: string,
     *      updated_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->subscription_id = $data['subscription_id'] ?? null;
        $this->status = OrderStatus::from($data['status']);
        $this->currency = $data['currency'];
        $this->subtotal = $data['subtotal'];
        $this->total = $data['total'];
        $this->billing_address = new BillingAddress($data['billing_address']);
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
    }
}
