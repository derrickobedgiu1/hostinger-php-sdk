<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Billing;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a Billing Address associated with Orders.
 */
final class BillingAddress extends Data
{
    /** @var string First name on the billing address. */
    public string $first_name;

    /** @var string Last name on the billing address. */
    public string $last_name;

    /** @var string|null Company name, if applicable. */
    public ?string $company;

    /** @var string|null Primary address line. */
    public ?string $address_1;

    /** @var string|null Secondary address line. */
    public ?string $address_2;

    /** @var string|null City name. */
    public ?string $city;

    /** @var string|null State or province name. */
    public ?string $state;

    /** @var string|null Postal or ZIP code. */
    public ?string $zip;

    /** @var string|null Country code (2-letter ISO). */
    public ?string $country;

    /** @var string|null Contact phone number. */
    public ?string $phone;

    /** @var string Contact email address. */
    public string $email;

    /**
     * @param array{
     *      first_name: string,
     *      last_name: string,
     *      company?: string|null,
     *      address_1?: string|null,
     *      address_2?: string|null,
     *      city?: string|null,
     *      state?: string|null,
     *      zip?: string|null,
     *      country?: string|null,
     *      phone?: string|null,
     *      email: string
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->company = $data['company'] ?? null;
        $this->address_1 = $data['address_1'] ?? null;
        $this->address_2 = $data['address_2'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->state = $data['state'] ?? null;
        $this->zip = $data['zip'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->email = $data['email'];
    }
}
