<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests;

use DerrickOb\HostingerApi\Enums\ActionsLock;
use DerrickOb\HostingerApi\Enums\ActionState;
use DerrickOb\HostingerApi\Enums\DomainStatus;
use DerrickOb\HostingerApi\Enums\DomainType;
use DerrickOb\HostingerApi\Enums\FirewallAction;
use DerrickOb\HostingerApi\Enums\OrderStatus;
use DerrickOb\HostingerApi\Enums\PaymentMethodType;
use DerrickOb\HostingerApi\Enums\PeriodUnit;
use DerrickOb\HostingerApi\Enums\Protocol;
use DerrickOb\HostingerApi\Enums\Source;
use DerrickOb\HostingerApi\Enums\SubscriptionStatus;
use DerrickOb\HostingerApi\Enums\VirtualMachineState;
use Faker\Generator;

/**
 * Factory for generating test data
 */
final class TestFactory
{
    /**
     * Generate a virtual machine data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Virtual machine data
     */
    public static function virtualMachine(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(5),
            'subscription_id' => $faker->regexify('[A-Za-z0-9]{15}'),
            'plan' => 'KVM ' . $faker->numberBetween(1, 4),
            'hostname' => $faker->domainName(),
            'state' => $faker->randomElement(array_column(VirtualMachineState::cases(), 'value')),
            'actions_lock' => $faker->randomElement(array_column(ActionsLock::cases(), 'value')),
            'cpus' => $faker->numberBetween(1, 8),
            'memory' => $faker->randomElement([2048, 4096, 8192, 16384]),
            'disk' => $faker->randomElement([40960, 81920, 122880]),
            'bandwidth' => $faker->randomNumber(9),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
            'ipv4' => [self::ipAddress(['address' => '192.168.' . $faker->numberBetween(0, 255) . '.' . $faker->numberBetween(1, 254)])],
            'template' => self::osTemplate(),
        ], $attributes);
    }

    /**
     * Generate an IP address data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> IP address data
     */
    public static function ipAddress(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(5),
            'address' => $faker->ipv4(),
            'ptr' => $faker->optional(0.7)->domainName(),
        ], $attributes);
    }

    /**
     * Generate an OS template data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> OS template data
     */
    public static function osTemplate(array $attributes = []): array
    {
        $faker = faker();
        $os = $faker->randomElement(['Ubuntu', 'Debian', 'CentOS', 'Fedora', 'Windows Server']);
        $version = $os === 'Windows Server' ? $faker->randomElement(['2019', '2022']) : $faker->randomElement(['20.04', '22.04', '11', '12', '8', '9', '37', '38']);

        $name = sprintf('%s %s', $os, $version);
        $description = sprintf('%s %s %s', $os, $version, ($os === 'Windows Server' ? '' : 'LTS'));

        return array_merge([
            'id' => $faker->randomNumber(5),
            'name' => $name,
            'description' => $description,
            'documentation' => $faker->optional(0.7)->url(),
        ], $attributes);
    }

    /**
     * Generate an action data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Action data
     */
    public static function action(array $attributes = []): array
    {
        $faker = faker();
        $createdAt = $faker->dateTimeThisMonth();
        $updatedAt = (clone $createdAt)->modify('+' . $faker->numberBetween(1, 10) . ' minutes');

        return array_merge([
            'id' => $faker->randomNumber(6),
            'name' => $faker->randomElement(['start', 'stop', 'restart', 'install', 'update', 'delete']),
            'state' => $faker->randomElement(array_column(ActionState::cases(), 'value')),
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => $updatedAt->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a backup data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Backup data
     */
    public static function backup(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(7),
            'location' => $faker->randomElement(['nl-srv-openvzbackups', 'us-srv-openvzbackups']),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a firewall data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Firewall data
     */
    public static function firewall(array $attributes = []): array
    {
        /** @var Generator */
        $faker = faker();
        $createdAt = $faker->dateTimeThisYear();
        $updatedAt = (clone $createdAt)->modify('+' . $faker->numberBetween(1, 30) . ' days');

        /** @var array<string, mixed> $rules */
        $rules = [];
        for ($i = 0; $i < $faker->numberBetween(1, 5); $i++) {
            $rules[] = self::firewallRule();
        }

        /** @var array<string, mixed> */
        return array_merge([
            'id' => $faker->randomNumber(5),
            'name' => implode(' ', (array) $faker->words(3, true)) . ' Firewall',
            'synced' => $faker->boolean(80),
            'rules' => $rules,
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => $updatedAt->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a firewall rule data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Firewall rule data
     */
    public static function firewallRule(array $attributes = []): array
    {
        $faker = faker();

        $protocols = array_column(Protocol::cases(), 'value');
        $protocol = $faker->randomElement($protocols);

        $port = 'any';
        if (in_array($protocol, ['TCP', 'UDP', 'SSH', 'HTTP', 'HTTPS', 'MySQL', 'PostgreSQL'])) {
            if ($faker->boolean(30)) {
                // Port range
                $start = $faker->numberBetween(1, 9000);
                $end = $faker->numberBetween($start + 1, 65535);
                $port = sprintf('%d:%d', $start, $end);
            } else {
                // Single port
                $port = match($protocol) {
                    'SSH' => '22',
                    'HTTP' => '80',
                    'HTTPS' => '443',
                    'MySQL' => '3306',
                    'PostgreSQL' => '5432',
                    default => (string)$faker->numberBetween(1, 65535)
                };
            }
        }

        /** @var array<string, mixed> */
        return array_merge([
            'id' => $faker->randomNumber(5),
            'action' => $faker->randomElement(array_column(FirewallAction::cases(), 'value')),
            'protocol' => $protocol,
            'port' => $port,
            'source' => $faker->randomElement(array_column(Source::cases(), 'value')),
            'source_detail' => $faker->randomElement(['any', $faker->ipv4(), $faker->ipv4() . '/24']),
        ], $attributes);
    }

    /**
     * Generate a domain data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Domain data
     */
    public static function domain(array $attributes = []): array
    {
        $faker = faker();
        $createdAt = $faker->dateTimeThisYear();
        $expiresAt = (clone $createdAt)->modify('+1 year');

        return array_merge([
            'id' => $faker->randomNumber(5),
            'name' => $faker->domainName(),
            'type' => $faker->randomElement(array_column(DomainType::cases(), 'value')),
            'status' => $faker->randomElement(array_column(DomainStatus::cases(), 'value')),
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'expires_at' => $expiresAt->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a catalog item data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Catalog item data
     */
    public static function catalogItem(array $attributes = []): array
    {
        $faker = faker();
        $id = 'hostingercom-vps-kvm' . $faker->numberBetween(1, 4);
        $name = 'KVM ' . $faker->numberBetween(1, 4);

        $prices = [];
        $periodUnits = array_column(PeriodUnit::cases(), 'value');

        for ($j = 1; $j <= $faker->numberBetween(1, 3); $j++) {
            $periodUnit = $faker->randomElement($periodUnits);
            $period = $periodUnit === 'month' ? $faker->numberBetween(1, 12) : $faker->numberBetween(1, 3);

            $prices[] = [
                'id' => sprintf('%s-usd-%d%s', $id, $period, $periodUnit[0]),
                'name' => sprintf('%s (billed every %d %s)', $name, $period, $periodUnit),
                'currency' => 'USD',
                'price' => $faker->numberBetween(500, 10000),
                'first_period_price' => $faker->numberBetween(300, 5000),
                'period' => $period,
                'period_unit' => $periodUnit,
            ];
        }

        return array_merge([
            'id' => $id,
            'name' => $name,
            'category' => 'VPS',
            'prices' => $prices,
        ], $attributes);
    }

    /**
     * Generate a payment method structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Payment method data
     */
    public static function paymentMethod(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(5),
            'name' => $faker->randomElement(['Credit Card', 'PayPal']),
            'identifier' => $faker->creditCardNumber(),
            'payment_method' => $faker->randomElement(array_column(PaymentMethodType::cases(), 'value')),
            'is_default' => $faker->boolean(20),
            'is_expired' => $faker->boolean(10),
            'is_suspended' => $faker->boolean(5),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
            'expires_at' => $faker->dateTimeInInterval('+1 year', '+5 years')->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a subscription structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Subscription data
     */
    public static function subscription(array $attributes = []): array
    {
        $faker = faker();
        $createdAt = $faker->dateTimeThisYear();
        $expiresAt = (clone $createdAt)->modify('+1 year');
        $nextBillingAt = (clone $createdAt)->modify('+1 month');

        return array_merge([
            'id' => $faker->regexify('[A-Za-z0-9]{15}'),
            'name' => 'KVM ' . $faker->numberBetween(1, 4),
            'status' => $faker->randomElement(array_column(SubscriptionStatus::cases(), 'value')),
            'billing_period' => $faker->randomElement([1, 3, 6, 12]),
            'billing_period_unit' => $faker->randomElement(array_column(PeriodUnit::cases(), 'value')),
            'currency_code' => 'USD',
            'total_price' => $faker->numberBetween(1000, 5000),
            'renewal_price' => $faker->numberBetween(1000, 5000),
            'auto_renew' => $faker->boolean(),
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'expires_at' => $expiresAt->format('Y-m-d\TH:i:s\Z'),
            'next_billing_at' => $nextBillingAt->format('Y-m-d\TH:i:s\Z'),
            'canceled_at' => null,
        ], $attributes);
    }

    /**
     * Generate an order structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Order data
     */
    public static function order(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(7),
            'subscription_id' => $faker->regexify('[A-Za-z0-9]{15}'),
            'status' => $faker->randomElement(array_column(OrderStatus::cases(), 'value')),
            'currency' => 'USD',
            'subtotal' => $faker->numberBetween(500, 10000),
            'total' => $faker->numberBetween(10000, 20000),
            'billing_address' => [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'company' => $faker->optional()->company(),
                'address_1' => $faker->optional()->address(),
                'address_2' => $faker->optional()->streetAddress(),
                'city' => $faker->optional()->city(),
                'state' => $faker->optional()->city(),
                'zip' => $faker->optional()->postcode(),
                'country' => $faker->countryCode(),
                'phone' => $faker->optional()->phoneNumber(),
                'email' => $faker->email(),
            ],
            'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a post-install script structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> Post-install script data
     */
    public static function postInstallScript(array $attributes = []): array
    {
        $faker = faker();
        $createdAt = $faker->dateTimeThisYear();
        $updatedAt = (clone $createdAt)->modify('+' . $faker->numberBetween(1, 30) . ' days');

        return array_merge([
            'id' => $faker->randomNumber(7),
            'name' => 'Script ' . $faker->word(),
            'content' => "#!/bin/bash\n\n" . $faker->paragraph(),
            'created_at' => $createdAt->format('Y-m-d\TH:i:s\Z'),
            'updated_at' => $updatedAt->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a DNS snapshot data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> DNS snapshot data
     */
    public static function dnsSnapshot(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(6),
            'reason' => $faker->sentence(),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a DNS snapshot with content data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> DNS snapshot with content data
     */
    public static function dnsSnapshotWithContent(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'id' => $faker->randomNumber(6),
            'reason' => $faker->sentence(),
            'snapshot' => json_encode(['zone' => 'records']),
            'created_at' => $faker->dateTimeThisYear()->format('Y-m-d\TH:i:s\Z'),
        ], $attributes);
    }

    /**
     * Generate a DNS name record data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> DNS name record data
     */
    public static function dnsNameRecord(array $attributes = []): array
    {
        $faker = faker();

        return array_merge([
            'content' => $faker->randomElement([$faker->ipv4(), $faker->domainName() . '.']),
            'disabled' => $faker->boolean(10),
        ], $attributes);
    }

    /**
     * Generate a DNS name data structure
     *
     * @param array<string, mixed> $attributes Attributes to override defaults
     *
     * @return array<string, mixed> DNS name data
     */
    public static function dnsName(array $attributes = []): array
    {
        $faker = faker();
        $recordTypes = ['A', 'AAAA', 'CNAME', 'MX', 'TXT', 'NS'];

        $records = [];
        for ($i = 0; $i < $faker->numberBetween(1, 3); $i++) {
            $records[] = self::dnsNameRecord();
        }

        return array_merge([
            'name' => $faker->randomElement(['@', $faker->word(), $faker->word() . '.' . $faker->word()]),
            'records' => $records,
            'ttl' => $faker->randomElement([300, 1800, 3600, 14400, 86400]),
            'type' => $faker->randomElement($recordTypes),
        ], $attributes);
    }
}
