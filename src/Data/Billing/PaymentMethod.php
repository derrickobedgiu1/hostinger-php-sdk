<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\PaymentMethodType;
use Exception;

/**
 * Represents a Payment method in the Hostinger billing System.
 */
final class PaymentMethod extends Data
{
    /** @var int Unique identifier for the payment method. */
    public int $id;

    /** @var string Display name for the payment method. */
    public string $name;

    /** @var string Masked identifier for the payment method (e.g., last 4 digits). */
    public string $identifier;

    /** @var PaymentMethodType Type of payment method (card, paypal). */
    public PaymentMethodType $payment_method;

    /** @var bool Whether this is the default payment method. */
    public bool $is_default;

    /** @var bool Whether this payment method has expired. */
    public bool $is_expired;

    /** @var bool Whether this payment method is suspended. */
    public bool $is_suspended;

    /** @var DateTimeImmutable Date and time when the payment method was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable|null Date and time when the payment method expires. */
    public ?DateTimeImmutable $expires_at;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      identifier: string,
     *      payment_method: string,
     *      is_default: bool,
     *      is_expired: bool,
     *      is_suspended: bool,
     *      created_at: string,
     *      expires_at?: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->identifier = $data['identifier'];
        $this->payment_method = PaymentMethodType::from($data['payment_method']);
        $this->is_default = $data['is_default'];
        $this->is_expired = $data['is_expired'];
        $this->is_suspended = $data['is_suspended'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->expires_at = isset($data['expires_at']) ? new DateTimeImmutable($data['expires_at']) : null;
    }
}
