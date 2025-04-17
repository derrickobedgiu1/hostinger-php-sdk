[![Hostinger Datacenter Cover](https://www.hostinger.com/blog/wp-content/uploads/sites/4/2021/12/data-centers-expansions-engineering-copy.jpg)](https://hostinger.com?REFERRALCODE=derrick)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/derrickob/hostinger-php-sdk.svg)](https://packagist.org/packages/derrickob/hostinger-php-sdk)
[![Tests](https://github.com/derrickobedgiu1/hostinger-php-sdk/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/derrickobedgiu1/hostinger-php-sdk/actions/workflows/tests.yml)
[![Code Style](https://img.shields.io/badge/code%20style-PSR--12-orange.svg)](https://www.php-fig.org/psr/psr-12/)
[![Static Analysis](https://img.shields.io/badge/static%20analysis-PHPStan-brightgreen.svg)](https://phpstan.org/)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](http://makeapullrequest.com)
[![License](https://img.shields.io/github/license/derrickobedgiu1/hostinger-php-sdk)](https://github.com/derrickobedgiu1/hostinger-php-sdk?tab=MIT-1-ov-file)

A complete PHP SDK for interacting with the Hostinger API, allowing you to programmatically manage your Hostinger resources including VPS, domains, billing, and more.

<!-- TOC -->
  * [Don't Have a Hostinger Account?](#dont-have-a-hostinger-account)
  * [Installation](#installation)
  * [API Token](#api-token)
  * [Usage](#usage)
    * [Initialize the Client](#initialize-the-client)
    * [Handle Errors](#handle-errors)
  * [Domains](#domains)
    * [Portfolio](#portfolio)
      * [Get Domain List](#get-domain-list)
  * [DNS](#dns)
    * [Snapshot](#snapshot)
      * [Get Snapshot](#get-snapshot)
      * [Restore Snapshot](#restore-snapshot)
      * [Get Snapshot List](#get-snapshot-list)
    * [Zone](#zone)
      * [Get Records](#get-records)
      * [Update Zone Records](#update-zone-records)
      * [Delete Zone Records](#delete-zone-records)
      * [Validate Zone Records](#validate-zone-records)
      * [Reset Zone Records](#reset-zone-records)
  * [Billing](#billing)
    * [Catalog](#catalog)
      * [Get Catalog Item List](#get-catalog-item-list)
    * [Orders](#orders)
      * [Create New Service Order](#create-new-service-order)
    * [Payment Methods](#payment-methods)
      * [Set Default Payment Method](#set-default-payment-method)
      * [Delete Payment Method](#delete-payment-method)
      * [Get Payment Method List](#get-payment-method-list)
    * [Subscriptions](#subscriptions)
      * [Cancel Subscription](#cancel-subscription)
      * [Get Subscription List](#get-subscription-list)
  * [VPS](#vps)
    * [Actions](#actions)
      * [Get Action](#get-action)
      * [Get Action List](#get-action-list)
    * [Backups](#backups)
      * [Delete Backup](#delete-backup)
      * [Get Backup List](#get-backup-list)
      * [Restore Backup](#restore-backup)
    * [Data Centers](#data-centers)
      * [Get Data Centers List](#get-data-centers-list)
    * [PTR Records](#ptr-records)
      * [Create PTR Record](#create-ptr-record)
      * [Delete PTR Record](#delete-ptr-record)
    * [Firewall](#firewall)
      * [Activate Firewall](#activate-firewall)
      * [Deactivate Firewall](#deactivate-firewall)
      * [Get Firewall](#get-firewall)
      * [Delete Firewall](#delete-firewall)
      * [Get Firewall List](#get-firewall-list)
      * [Create New Firewall](#create-new-firewall)
      * [Update Firewall Rule](#update-firewall-rule)
      * [Delete Firewall Rule](#delete-firewall-rule)
      * [Create Firewall Rule](#create-firewall-rule)
      * [Sync Firewall](#sync-firewall)
    * [Malware Scanner](#malware-scanner)
      * [Get Scan Metrics](#get-scan-metrics)
      * [Install Monarx](#install-monarx)
      * [Uninstall Monarx](#uninstall-monarx)
    * [OS Templates](#os-templates)
      * [Get Template](#get-template)
      * [Get Template List](#get-template-list)
    * [Post-Install Scripts](#post-install-scripts)
      * [Get Post-Install Script](#get-post-install-script)
      * [Update Post-Install Script](#update-post-install-script)
      * [Delete a Post-Install Script](#delete-a-post-install-script)
      * [Get Post-Install Script List](#get-post-install-script-list)
      * [Create Post-Install Script](#create-post-install-script)
    * [Public Keys](#public-keys)
      * [Attach Public Key](#attach-public-key)
      * [Delete a Public Key](#delete-a-public-key)
      * [Get Public Key List](#get-public-key-list)
      * [Create New Public Key](#create-new-public-key)
    * [Recovery](#recovery)
      * [Start Recovery Mode](#start-recovery-mode)
      * [Stop Recovery Mode](#stop-recovery-mode)
    * [Snapshots](#snapshots)
      * [Get Snapshot](#get-snapshot-1)
      * [Create Snapshot](#create-snapshot)
      * [Delete Snapshot](#delete-snapshot)
      * [Restore Snapshot](#restore-snapshot-1)
    * [Virtual Machine](#virtual-machine)
      * [Get Attached Public Keys](#get-attached-public-keys)
      * [Set Hostname](#set-hostname)
      * [Reset Hostname](#reset-hostname)
      * [Get Virtual Machine](#get-virtual-machine)
      * [Get Virtual Machine List](#get-virtual-machine-list)
      * [Get Metrics](#get-metrics)
      * [Set Nameservers](#set-nameservers)
      * [Set Panel Password](#set-panel-password)
      * [Recreate Virtual Machine](#recreate-virtual-machine)
      * [Restart Virtual Machine](#restart-virtual-machine)
      * [Set Root Password](#set-root-password)
      * [Setup New Virtual Machine](#setup-new-virtual-machine)
      * [Start Virtual Machine](#start-virtual-machine)
      * [Stop Virtual Machine](#stop-virtual-machine)
  * [Testing](#testing)
  * [Contributing](#contributing)
  * [Credits](#credits)
  * [License](#license)
<!-- TOC -->

## Don't Have a Hostinger Account?
[Hostinger](https://hostinger.com?REFERRALCODE=derrick) offers affordable web hosting and VPS solutions with excellent performance, uptime and has an amazing support team. If you don't have a Hostinger account yet, you can sign up using [this referral link](https://hostinger.com?REFERRALCODE=derrick) to get 20% additional discount on top of Hostinger's regular discounts.

***Disclaimer**: If you use the referral link, I may earn a commission from Hostinger and you'll get 20% discount on your purchase.*

## Installation

You can install the package via composer:

```bash
composer require derrickob/hostinger-php-sdk
```

## API Token

To use this SDK, you'll need an API token from Hostinger. You can create one from the [Account page](https://hpanel.hostinger.com/profile/api) of the Hostinger Panel.

## Usage

### Initialize the Client

```php
use DerrickOb\HostingerApi\Hostinger;

// Initialize with just an API token
$hostinger = new Hostinger('your-api-token');

// Or with additional options
$hostinger = new Hostinger('your-api-token', [
    'timeout' => 30,                                 // Request timeout in seconds
    'base_url' => 'https://developers.hostinger.com', // API base URL
    'api_version' => 'v1',                           // API version
]);
```

### Handle Errors

All API errors are converted to exceptions:

```php
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;

try {
    $catalogs = $hostinger->billing()->catalog()->list();
} catch (AuthenticationException $e) {
    // Handle authentication errors (401)
    $message = $e->getMessage();
} catch (ValidationException $e) {
    // Handle validation errors (422)
    $message = $e->getMessage();
    // Get detailed validation errors
    $errors = $e->getErrors(); // ['field_1' => ['Error message 1', ...], ...]
} catch (RateLimitException $e) {
    // Handle rate limit errors (429)
    $message = $e->getMessage();
} catch (ApiException $e) {
    // Handle any other API errors (4xx, 5xx)
    $message = $e->getMessage();
    $code = $e->getCode();

    // Get correlation ID for support
    $correlationId = $e->getCorrelationId();
}
```

## Domains

### Portfolio

#### Get Domain List

Retrieves a list of all domains associated with your account.

```php
$domains = $hostinger->domains()->portfolio()->list();

foreach ($domains as $domain) {
    $domain->id; // 13632
    $domain->name; // mydomain.tld
    $domain->type->value; // domain"
    $domain->status->value; // active
    $domain->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $domain->expires_at ? $domain->expires_at->format('Y-m-d H:i:s') : null; // 2025-03-27 11:54:22

    $domain->toArray(); // ['id' => 13632, 'name' => 'mydomain.tld', 'type' => 'domain', 'status' => 'active', ...]
}
```

## DNS

### Snapshot

#### Get Snapshot

Retrieves a specific DNS snapshot

```php
$domainName = "mydomain.tld";
$snapshotId = 53513053;
$snapshot = $hostinger->dns()->snapshots()->get($domainName, $snapshotId);

$snapshot->id; // 53513053
$snapshot->reason; // Zone records update request
$snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

foreach ($snapshot->snapshot as $recordGroup) {
    $recordGroup->name; // www
    $recordGroup->type; // A
    $recordGroup->ttl; // 14400
    foreach ($recordGroup->records as $recordValue) {
         $recordValue->content; // mydomain.tld.
         $recordValue->disabled; // false
    }
}

$snapshot->toArray(); // ['id' => 53513053, 'reason' => '...', 'snapshot' => [[...], ...], 'created_at' => ...]
```

#### Restore Snapshot

Restores a domain's DNS zone to the state captured in a selected snapshot.

```php
$domainName = "mydomain.tld";
$snapshotId = 53513053;
$response = $hostinger->dns()->snapshots()->restore($domainName, $snapshotId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Snapshot List

Retrieves a list of DNS snapshots for a specific domain.

```php
$domainName = "mydomain.tld";
$snapshots = $hostinger->dns()->snapshots()->list($domainName);

foreach ($snapshots as $snapshot) {
    $snapshot->id; // 5341
    $snapshot->reason; // Zone records update request
    $snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

    $snapshot->toArray(); // ['id' => 5341, 'reason' => '...', 'created_at' => ...]
}
```

### Zone

#### Get Records

Retrieves all DNS records for a specific domain.

```php
$domainName = "mydomain.tld";
$recordGroups = $hostinger->dns()->zones()->getRecords($domainName);

foreach ($recordGroups as $group) {
    $group->name; // www
    $group->type; // A
    $group->ttl; // 14400

    foreach ($group->records as $recordValue) {
        $recordValue->content; // mydomain.tld
        $recordValue->disabled; // false

        $recordValue->toArray(); // ['content' => '...', 'disabled' => false]
    }

    $group->toArray(); // ['name' => 'www', 'records' => [[...], ...], 'ttl' => 14400, 'type' => 'A']
}
```

#### Update Zone Records

Updates DNS records for the selected domain. Using overwrite = true (default) replaces records; otherwise, appends or updates TTLs.

```php
$domainName = "mydomain.tld";
$data = [
    'overwrite' => true, // Optional
    'zone' => [
        [
            'name' => 'www',
            'records' => [['content' => '192.0.2.1']],
            'ttl' => 3600, // Optional
            'type' => 'A',
        ],
        [
            'name' => 'www',
            'records' => [['content' => 'example.com.']],
            'type' => 'CNAME',
        ],
    ],
];

$response = $hostinger->dns()->zones()->update($domainName, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Delete Zone Records

Deletes specific DNS records based on name and type filters.

```php
$domainName = "mydomain.tld";
$data = [
    'filters' => [
        ['name' => '@', 'type' => 'A']
    ],
];

$response = $hostinger->dns()->zones()->delete($domainName, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Validate Zone Records

Validates DNS records before attempting an update. Throws a ValidationException if invalid.

```php
$domainName = "mydomain.tld";
$data = [
    'zone' => [
        [
            'name' => 'valid',
            'records' => [['content' => '192.0.2.10']],
            'type' => 'A',
        ]
    ],
];

try {
    $response = $hostinger->dns()->zones()->validate($domainName, $data);
    $response->message;
    $response->toArray(); // ['message' => '...']
} catch (\DerrickOb\HostingerApi\Exceptions\ValidationException $e) {
    // Handle validation failure
    echo "Validation failed: " . $e->getMessage();
    print_r($e->getErrors());
}
```

#### Reset Zone Records

Resets the DNS zone for a domain to the default Hostinger records.

```php
$domainName = "mydomain.tld";

// Reset with defaults
$response = $hostinger->dns()->zones()->reset($domainName);
$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']


// Reset with options
$data = [
    'sync' => true, // Optional
    'reset_email_records' => false, // Optional
    'whitelisted_record_types' => ['MX', 'TXT'], // Optional
];

$response = $hostinger->dns()->zones()->reset($domainName, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

## Billing

### Catalog

#### Get Catalog Item List

Retrieves a list of catalog items available for order. Prices are in cents.

```php
$catalogs = $hostinger->billing()->catalog()->list();

foreach ($catalogs as $catalog) {
    $catalog->id; // hostingercom-vps-kvm2
    $catalog->name; // KVM 2
    $catalog->category; // VPS

    foreach ($catalog->prices as $price) {
        $price->id; // hostingercom-vps-kvm2-usd-1m
        $price->name; // KVM 2 (billed every month)
        $price->currency; // USD
        $price->price; // 1799
        $price->first_period_price; // 899
        $price->period; // 1
        $price->period_unit->value; // day

        $price->toArray(); // ['id' => '...', 'name' => '...', 'currency' => 'USD', ...]
    }

    $catalog->toArray(); // ['id' => '...', 'name' => 'KVM 2', 'category' => 'VPS', 'prices' => [[...], ...]]
}
```

### Orders

#### Create New Service Order

Creates a new service order. Requires a payment method ID and catalog item price IDs. Orders created via API are set for auto-renewal. Prices are in cents

```php
$data = [
    'payment_method_id' => 517244,
    'items' => [
        [
            'item_id' => 'hostingercom-vps-kvm2-usd-1m', // required: Price ID from Catalog
            'quantity' => 1, // required: Quantity
        ],
    ],
    'coupons' => ['Coupon 3'], // optional: Array of coupon codes
];

$order = $hostinger->billing()->orders()->create($data);

$order->id; // 2957086
$order->subscription_id; // Azz353Uhl1xC54pR0
$order->status->value; // completed
$order->currency; // USD
$order->subtotal; // 899
$order->total; // 1088

$order->billing_address->first_name; // John
$order->billing_address->last_name; // Doe
$order->billing_address->company; // null
$order->billing_address->address_1; // null
$order->billing_address->address_2; // null
$order->billing_address->city; // null
$order->billing_address->state; // null
$order->billing_address->zip; // null
$order->billing_address->country; // NL
$order->billing_address->phone; // null
$order->billing_address->email; // john@doe.tld

$order->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$order->updated_at->format('Y-m-d H:i:s'); // 2025-03-27 11:54:22

$order->toArray(); // ['id' => 2957086, 'subscription_id' => '...', 'status' => 'completed', 'billing_address' => [...], ...]
```

### Payment Methods

#### Set Default Payment Method

Sets a specific payment method as the default for your account.

```php
$paymentMethodId = 9693613;
$response = $hostinger->billing()->paymentMethods()->setDefault($paymentMethodId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Delete Payment Method

Deletes a payment method from your account.

```php
$paymentMethodId = 9693613;
$response = $hostinger->billing()->paymentMethods()->delete($paymentMethodId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Payment Method List

Retrieves available payment methods linked to your account.

```php
$paymentMethods = $hostinger->billing()->paymentMethods()->list();

foreach ($paymentMethods as $paymentMethod) {
    $paymentMethod->id; // 6523
    $paymentMethod->name; // Credit Card
    $paymentMethod->identifier; // 1234*****6464
    $paymentMethod->payment_method->value; // card
    $paymentMethod->is_default; // true
    $paymentMethod->is_expired; // false
    $paymentMethod->is_suspended; // false
    $paymentMethod->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $paymentMethod->expires_at ? $paymentMethod->expires_at->format('Y-m-d H:i:s') : null; // 2025-03-27 11:54:22

    $paymentMethod->toArray(); // ['id' => 6523, 'name' => 'Credit Card', 'identifier' => '...', 'payment_method' => 'card', ...]
}
```

### Subscriptions

#### Cancel Subscription

Cancels a subscription and stops further billing.

```php
$subscriptionId = "Cxy353Uhl1xC54pG6";

// Cancel immediately with a reason
$data = [
    'reason_code' => 'other',
    'cancel_option' => 'immediately',
];

$response = $hostinger->billing()->subscriptions()->cancel($subscriptionId, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']


// Cancel at the end of the term
$response = $hostinger->billing()->subscriptions()->cancel($subscriptionId);
$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Subscription List

Retrieves all subscriptions associated with your account. Prices are in cents.

```php
$subscriptions = $hostinger->billing()->subscriptions()->list();

foreach ($subscriptions as $subscription) {
    $subscription->id; // Azz36nUfKX1S1MSF
    $subscription->name; // KVM 1
    $subscription->status->value; // active
    $subscription->billing_period; // 1
    $subscription->billing_period_unit->value; // day
    $subscription->currency_code; // USD
    $subscription->total_price; // 1799
    $subscription->renewal_price; // 1799
    $subscription->auto_renew; // true
    $subscription->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $subscription->expires_at->format('Y-m-d H:i:s'); // 2025-03-27 11:54:22
    $subscription->next_billing_at ? $subscription->next_billing_at->format('Y-m-d H:i:s') : null; // 2025-02-28 11:54:22

    $subscription->toArray(); // ['id' => '...', 'name' => 'KVM 1', 'status' => 'active', 'auto_renew' => true, ...]
}
```

## VPS

### Actions

#### Get Action

Retrieves details for a specific action performed on a VM.

```php
$virtualMachineId = 1268054;
$actionId = 8123712;
$action = $hostinger->vps()->actions()->get($virtualMachineId, $actionId);

$action->id; // 8123712
$action->name; // action_name
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Get Action List

Retrieves a paginated list of actions performed on a specific VM.

```php
$virtualMachineId = 1268054;
$actions = $hostinger->vps()->actions()->list($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$actions->getCurrentPage(); // 1
$actions->getPerPage(); // 15
$actions->getTotal(); // 100

foreach ($actions->getData() as $action) {
    $action->id; // 8123712
    $action->name; // action_name
    $action->state->value; // success
    $action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
    $action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

    $action->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
}

$actions->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

### Backups

#### Delete Backup

Deletes a specific backup.

```php
$virtualMachineId = 1268054;
$backupId = 8676502;
$response = $hostinger->vps()->backups()->delete($virtualMachineId, $backupId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Backup List

Retrieves a paginated list of backups for a specific virtual machine.

```php
$virtualMachineId = 1268054;
$backups = $hostinger->vps()->backups()->list($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$backups->getCurrentPage(); // 1
$backups->getPerPage(); // 15
$backups->getTotal(); // 100

foreach ($backups->getData() as $backup) {
    $backup->id; // 325
    $backup->location; // nl-srv-openvzbackups
    $backup->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

    $backup->toArray(); // ['id' => 325, 'location' => 'nl-srv-openvzbackups', 'created_at' => ...]
}

$backups->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Restore Backup

Restores a VM to the state of a specific backup. **Warning: Overwrites current VM data!**

```php
$virtualMachineId = 1268054;
$backupId = 8676502;
$action = $hostinger->vps()->backups()->restore($virtualMachineId, $backupId);

$action->id; // 8123712
$action->name; // action_name
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

### Data Centers

#### Get Data Centers List

Retrieves a list of all available Hostinger data centers where VPS can be deployed.

```php
$dataCenters = $hostinger->vps()->dataCenters()->list();

foreach ($dataCenters as $dataCenter) {
    $dataCenter->id; // 29
    $dataCenter->name; // phx
    $dataCenter->location; // us
    $dataCenter->city; // Phoenix
    $dataCenter->continent; // North America

    $dataCenter->toArray(); // ['id' => 29, 'name' => 'phx', 'location' => 'us', 'city' => 'Phoenix', 'continent' => 'North America']
}
```

### PTR Records

#### Create PTR Record

Creates or updates the PTR (reverse DNS) record for a VM's primary IP, pointing to the VM's hostname.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->ptrRecords()->create($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123728, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Delete PTR Record

Deletes the PTR record for a VM's primary IP.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->ptrRecords()->delete($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123729, 'name' => 'action_name', 'state' => 'success', ...]
```

### Firewall

#### Activate Firewall

Activates a firewall for a specific VM. Only one firewall can be active per VM.

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$response = $hostinger->vps()->firewalls()->activate($firewallId, $virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123715, 'name' => 'action_name', 'state' => 'sent', ...]
```

#### Deactivate Firewall

Deactivates the currently active firewall for a specific VM.

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$response = $hostinger->vps()->firewalls()->deactivate($firewallId, $virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123716, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Get Firewall

Retrieves details for a specific firewall, including its rules.

```php
$firewallId = 9449049;
$firewall = $hostinger->vps()->firewalls()->get($firewallId);

$firewall->id; // 65224
$firewall->name; // HTTP and SSH only
$firewall->synced; // false
$firewall->created_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00
$firewall->updated_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00

foreach ($firewall->rules as $rule) {
    $rule->id; // 24541
    $rule->action->value; // accept
    $rule->protocol->value; // TCP
    $rule->port; // 1024:2048
    $rule->source->value; // any
    $rule->source_detail; // any

    $rule->toArray(); // ['id' => 24541, 'action' => 'accept', 'protocol' => 'TCP', ...]
}

$firewall->toArray(); // ['id' => 65224, 'name' => '...', 'synced' => ..., 'rules' => [...], ...]
```

#### Delete Firewall

Deletes a firewall. Any VMs using it will have the firewall deactivated.

```php
$firewallId = 9449049;
$response = $hostinger->vps()->firewalls()->delete($firewallId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Firewall List

Retrieves a paginated list of all firewalls available in your account. Access requires having at least one VPS.

```php
$firewalls = $hostinger->vps()->firewalls()->list(['page' => 1]);

// Access pagination metadata
$firewalls->getCurrentPage(); // 1
$firewalls->getPerPage(); // 15
$firewalls->getTotal(); // 100

foreach ($firewalls->getData() as $firewall) {
    $firewall->id; // 65224
    $firewall->name; // HTTP and SSH only
    $firewall->synced; // false
    $firewall->created_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00
    $firewall->updated_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00

    foreach ($firewall->rules as $rule) {
        $rule->id; // 24541
        $rule->action->value; // accept
        $rule->protocol->value; // TCP
        $rule->port; // 1024:2048
        $rule->source->value; // any
        $rule->source_detail; // any

        $rule->toArray(); // ['id' => 24541, 'action' => 'accept', 'protocol' => 'TCP', ...]
    }

    $firewall->toArray(); // ['id' => 65224, 'name' => '...', 'synced' => false, 'rules' => [[...], ...], ...]
}

$firewalls->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create New Firewall

Creates a new, empty firewall group.

```php
$data = [
    'name' => 'My Firewall Group',
];

$firewall = $hostinger->vps()->firewalls()->create($data);

$firewall->id; // 65224
$firewall->name; // HTTP and SSH only
$firewall->synced; // false
$firewall->rules; // empty array []
$firewall->created_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00
$firewall->updated_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00

$firewall->toArray(); // ['id' => 65224, 'name' => 'HTTP and SSH only', 'synced' => false, 'rules' => [], ...]
```

#### Update Firewall Rule

Updates an existing rule within a firewall. The firewall becomes unsynced if attached to VMs.

```php
$firewallId = 9449049;
$ruleId = 8941182;
$data = [
    'protocol' => 'UDP',
    'port' => '443',
    'source' => 'any',
    'source_detail' => '351.15.24.0/24',
    'action' => 'accept',
];

$rule = $hostinger->vps()->firewalls()->updateRule($firewallId, $ruleId, $data);

$rule->id; // 24541
$rule->action->value; // accept
$rule->protocol->value; // UDP
$rule->port; // 1024:2048
$rule->source->value; // any
$rule->source_detail; // any

$rule->toArray(); // ['id' => 24541, 'action' => 'accept', 'protocol' => 'UDP', ...]
```

#### Delete Firewall Rule

Deletes a specific rule from a firewall. The firewall becomes unsynced if attached to VMs.

```php
$firewallId = 9449049;
$ruleId = 8941182;
$response = $hostinger->vps()->firewalls()->deleteRule($firewallId, $ruleId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Create Firewall Rule

Adds a new rule to an existing firewall. The firewall becomes unsynced if attached to VMs.

```php
$firewallId = 9449049;
$data = [
    'protocol' => 'TCP',
    'port' => '443',
    'source' => 'any',
    'source_detail' => '351.15.24.0/24',
    'action' => 'accept',
];

$rule = $hostinger->vps()->firewalls()->createRule($firewallId, $data);

$rule->id; // 8941183
$rule->action->value; // accept
$rule->protocol->value; // TCP
$rule->port; // 1024:2048
$rule->source->value; // any
$rule->source_detail; // any

$rule->toArray(); // ['id' => 8941183, 'action' => 'accept', 'protocol' => 'TCP', ...]
```

#### Sync Firewall

Syncs firewall rules to an attached VM if the firewall is marked as unsynced.

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$response = $hostinger->vps()->firewalls()->sync($firewallId, $virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

### Malware Scanner

#### Get Scan Metrics

Retrieves the latest Monarx malware scan metrics for a VM.

```php
$virtualMachineId = 1268054;
$metrics = $hostinger->vps()->malwareScanner()->getMetrics($virtualMachineId);

$metrics->records; // 1
$metrics->malicious; // 2
$metrics->compromised; // 3
$metrics->scanned_files; // 193218
$metrics->scan_started_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$metrics->scan_ended_at ? $metrics->scan_ended_at->format('Y-m-d H:i:s'); // 2025-03-27 11:54:22

$metrics->toArray(); // ['records' => 1, 'malicious' => 2, 'compromised' => 3, ...]
```

#### Install Monarx

Installs the Monarx malware scanner on a VM.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->malwareScanner()->install($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Uninstall Monarx

Uninstalls the Monarx malware scanner from a VM.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->malwareScanner()->uninstall($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

### OS Templates

#### Get Template

Retrieves details for a specific OS template.

```php
$templateId = 2868928;
$template = $hostinger->vps()->templates()->get($templateId);

$template->id; // 2868928
$template->name; // Ubuntu 20.04 LTS
$template->description; // Ubuntu 20.04 LTS
$template->documentation; // https://docs.ubuntu.com

$template->toArray(); // ['id' => 2868928, 'name' => '...', 'description' => '...', 'documentation' => null]
```

#### Get Template List

Retrieves a list of available OS templates for installing on virtual machines.

```php
$templates = $hostinger->vps()->templates()->list();

foreach ($templates as $template) {
    $template->id; // 6523
    $template->name; // Ubuntu 20.04 LTS
    $template->description; // Ubuntu 20.04 LTS
    $template->documentation; // https://docs.ubuntu.com

    $template->toArray(); // ['id' => 6523, 'name' => 'Ubuntu 20.04 LTS', 'description' => '...', 'documentation' => '...']
}
```

### Post-Install Scripts

#### Get Post-Install Script

Retrieves details of a specific post-install script.

```php
$postInstallScriptId = 9568314;
$script = $hostinger->vps()->postInstallScripts()->get($postInstallScriptId);

$script->id; // 325
$script->name; // My Setup Script
$script->content; // #!/bin/bash\\napt-get update\\napt-get install -y nginx
$script->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$script->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$script->toArray(); // ['id' => 325, 'name' => '...', 'content' => '...', ...]
```

#### Update Post-Install Script

Updates the name and/or content of an existing post-install script.

```php
$postInstallScriptId = 9568314;
$data = [
    'name' => 'My Script',
    'content' => "#!/bin/bash\n\necho 'Hello, World!'",
];

$script = $hostinger->vps()->postInstallScripts()->update($postInstallScriptId, $data);

$script->id; // 325
$script->name; // My Setup Script
$script->content; // #!/bin/bash\\napt-get update\\napt-get install -y nginx
$script->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$script->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$script->toArray(); // ['id' => 325, 'name' => 'My Setup Script', 'content' => '...', ...]
```

#### Delete a Post-Install Script

Deletes a post-install script from your account.

```php
$postInstallScriptId = 9568314;
$response = $hostinger->vps()->postInstallScripts()->delete($postInstallScriptId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Post-Install Script List

Retrieves a paginated list of post-install scripts associated with your account.

```php
$postInstallScripts = $hostinger->vps()->postInstallScripts()->list(['page' => 1]);

// Access pagination metadata
$postInstallScripts->getCurrentPage(); // 1
$postInstallScripts->getPerPage(); // 15
$postInstallScripts->getTotal(); // 100

foreach ($postInstallScripts->getData() as $script) {
    $script->id; // 325
    $script->name; // "My Setup Script"
    $script->content; // "#!/bin/bash\napt-get update\napt-get install -y nginx"
    $script->created_at->format('Y-m-d H:i:s'); // "2025-02-27 11:54:22"
    $script->updated_at->format('Y-m-d H:i:s'); // "2025-03-19 11:54:22"

    $script->toArray(); // ['id' => 325, 'name' => 'My Setup Script', 'content' => '...', ...]
}

$postInstallScripts->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create Post-Install Script

Creates a new script that can be run after OS installation on a VM.

```php
$data = [
    'name' => 'My Script',
    'content' => "#!/bin/bash\n\necho 'Hello, World!'",
];
$script = $hostinger->vps()->postInstallScripts()->create($data);

$script->id; // 325
$script->name; // My Setup Script
$script->content; // "#!/bin/bash\necho 'Hello, World!'"
$script->created_at->format('Y-m-d H:i:s');
$script->updated_at->format('Y-m-d H:i:s');

$script->toArray(); // ['id' => 325, 'name' => 'My Setup Script', 'content' => '...', ...]
```

### Public Keys

#### Attach Public Key

Attaches existing public keys from your account to a specific VM.

```php
$virtualMachineId = 1268054;
$data = [
    'ids' => [18232, 10230230],
];

$response = $hostinger->vps()->publicKeys()->attach($virtualMachineId, $data);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Delete a Public Key

Deletes a public key from your account. This does *not* remove it from VMs it's already attached to.

```php
$publicKeyId = 6672861;
$response = $hostinger->vps()->publicKeys()->delete($publicKeyId);

$response->message; // Request accepted

$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Public Key List

Retrieves a paginated list of SSH public keys associated with your account.

```php
$publicKeys = $hostinger->vps()->publicKeys()->list(['page' => 1]);

// Access pagination metadata
$publicKeys->getCurrentPage(); // 1
$publicKeys->getPerPage(); // 15
$publicKeys->getTotal(); // 100

foreach ($publicKeys->getData() as $key) {
    $key->id; // 325
    $key->name; // My public key
    $key->key; // ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD...

    $key->toArray(); // ['id' => 325, 'name' => 'My public key', 'key' => 'ssh-rsa...']
}

$publicKeys->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create New Public Key

Adds a new SSH public key to your account, which can then be attached to VMs.

```php
$data = [
    'name' => 'My Public Key',
    'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAA...',
];

$publicKey = $hostinger->vps()->publicKeys()->create($data);

$publicKey->id; // 325
$publicKey->name; // My Public Key
$publicKey->key; // ssh-rsa AAAAB3NzaC1yc2EAAA...

$publicKey->toArray(); // ['id' => 325, 'name' => 'My Public Key', 'key' => 'ssh-rsa...']
```

### Recovery

#### Start Recovery Mode

Boots a VM into a temporary recovery environment with the specified root password. The original disk is mounted at `/mnt`.

```php
$virtualMachineId = 1268054;
$data = [
    'root_password' => 'oMeNRustosIO',
];

$response = $hostinger->vps()->recovery()->start($virtualMachineId, $data);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Stop Recovery Mode

Boots the VM back into its normal operating system from recovery mode.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->recovery()->stop($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

### Snapshots

#### Get Snapshot

Retrieves information about the current snapshot for a VM (only one snapshot is kept per VM).

```php
$virtualMachineId = 1268054;
$snapshot = $hostinger->vps()->snapshots()->get($virtualMachineId);

$snapshot->id; // 325
$snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$snapshot->expires_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$snapshot->toArray(); // ['id' => 325, 'created_at' => ..., 'expires_at' => ...]
```

#### Create Snapshot

Creates a new snapshot of a VM. **Warning: Overwrites any existing snapshot for this VM!**

```php
$virtualMachineId = 1268054;
$snapshot = $hostinger->vps()->snapshots()->create($virtualMachineId);

$snapshot->id; // 8123712
$snapshot->name; // action_name
$snapshot->state->value; // success
$snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$snapshot->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$snapshot->toArray(); // ['id' => 8123732, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Delete Snapshot

Deletes the existing snapshot for a VM.

```php
$virtualMachineId = 1268054;
$snapshot = $hostinger->vps()->snapshots()->delete($virtualMachineId);

$snapshot->id; // 8123712
$snapshot->name; // action_name
$snapshot->state->value; // success
$snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$snapshot->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$snapshot->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Restore Snapshot

Restores a VM to the state of its existing snapshot. **Warning: Overwrites current VM data!**

```php
$virtualMachineId = 1268054;
$snapshot = $hostinger->vps()->snapshots()->restore($virtualMachineId);

$snapshot->id; // 8123712
$snapshot->name; // action_name
$snapshot->state->value; // success
$snapshot->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$snapshot->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$snapshot->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

### Virtual Machine

#### Get Attached Public Keys

Retrieves a paginated list of SSH public keys attached to a specific virtual machine.

```php
$virtualMachineId = 1268054;
$attachedPublicKeys = $hostinger->vps()->virtualMachines()->getAttachedPublicKeys($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$attachedPublicKeys->getCurrentPage(); // 1
$attachedPublicKeys->getPerPage(); // 15
$attachedPublicKeys->getTotal(); // 100

foreach ($attachedPublicKeys->getData() as $key) {
    $key->id; // 325
    $key->name; // My public key
    $key->key; // ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD...

    $key->toArray(); // ['id' => 325, 'name' => 'My public key', 'key' => 'ssh-rsa...']
}

$attachedPublicKeys->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Set Hostname

Sets the hostname for a virtual machine.

```php
$virtualMachineId = 1268054;
$data = [
    'hostname' => 'my.server.tld',
];
$host = $hostinger->vps()->virtualMachines()->setHostName($virtualMachineId, $data['hostname']);

$host->id; // 8123712
$host->name; // action_name
$host->state->value; // success
$host->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$host->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$host->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Reset Hostname

Resets the hostname and PTR record to the default value.

```php
$virtualMachineId = 1268054;
$host = $hostinger->vps()->virtualMachines()->resetHostName($virtualMachineId);

$host->id; // 8123712
$host->name; // action_name
$host->state->value; // success
$host->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$host->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$host->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Get Virtual Machine

Retrieves detailed information for a specific virtual machine.

```php
$virtualMachineId = 1268054;
$virtualMachine = $hostinger->vps()->virtualMachines()->get($virtualMachineId);

$virtualMachine->id; // 17923
$virtualMachine->firewall_group_id; // null
$virtualMachine->subscription_id; // Azz353Uhl1xC54pR0
$virtualMachine->plan; // KVM 4
$virtualMachine->hostname; // srv17923.hstgr.cloud
$virtualMachine->state->value; // running
$virtualMachine->actions_lock->value; // unlocked
$virtualMachine->cpus; // 4
$virtualMachine->memory; // 8192
$virtualMachine->disk; // 51200
$virtualMachine->bandwidth; // 1073741824
$virtualMachine->ns1; // 1.1.1.1
$virtualMachine->ns2; // 8.8.8.8
$virtualMachine->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

if ($virtualMachine->ipv4) {
    foreach ($virtualMachine->ipv4 as $ip4) {
        $ip4->id; // 52347
        $ip4->address; // 213.331.273.15
        $ip4->ptr; // something.domain.tld
        $ip4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
    }
}

if ($virtualMachine->ipv6) {
     foreach ($virtualMachine->ipv6 as $ip6) {
         $ip6->id; // 52347
         $ip6->address; // 2a00:4000:f:eaee::1
         $ip6->ptr; // something.domain.tld
         $ip6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
     }
}

if ($virtualMachine->template) {
    $virtualMachine->template->id; // 6523
    $virtualMachine->template->name; // Ubuntu 20.04 LTS
    $virtualMachine->template->description; // Ubuntu 20.04 LTS
    $virtualMachine->template->documentation; // https://docs.ubuntu.com
    $virtualMachine->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
}

$virtualMachine->toArray(); // ['id' => 17923, 'firewall_group_id' => null, 'hostname' => '...', 'state' => 'running', ...]
```

#### Get Virtual Machine List

Retrieves a list of all virtual machines in your account.

```php
$virtualMachines = $hostinger->vps()->virtualMachines()->list();

foreach ($virtualMachines as $virtualMachine) {
    $virtualMachine->id; // 17923
    $virtualMachine->firewall_group_id; // null
    $virtualMachine->subscription_id; // Azz353Uhl1xC54pR0
    $virtualMachine->plan; // KVM 4
    $virtualMachine->hostname; // srv17923.hstgr.cloud
    $virtualMachine->state->value; // running
    $virtualMachine->actions_lock->value; // unlocked
    $virtualMachine->cpus; // 4
    $virtualMachine->memory; // 8192
    $virtualMachine->disk; // 51200
    $virtualMachine->bandwidth; // 1073741824
    $virtualMachine->ns1; // 1.1.1.1
    $virtualMachine->ns2; // 8.8.8.8
    $virtualMachine->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

    if ($virtualMachine->ipv4) {
        foreach ($virtualMachine->ipv4 as $ip4) {
            $ip4->id; // 52347
            $ip4->address; // 213.331.273.15
            $ip4->ptr; // something.domain.tld
            $ip4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
        }
    }

    if ($virtualMachine->ipv6) {
         foreach ($virtualMachine->ipv6 as $ip6) {
             $ip6->id; // 52347
             $ip6->address; // 2a00:4000:f:eaee::1
             $ip6->ptr; // something.domain.tld
             $ip6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
         }
    }

    if ($virtualMachine->template) {
        $virtualMachine->template->id; // 6523
        $virtualMachine->template->name; // Ubuntu 20.04 LTS
        $virtualMachine->template->description; // Ubuntu 20.04 LTS
        $virtualMachine->template->documentation; // https://docs.ubuntu.com
        $virtualMachine->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
    }

    $virtualMachine->toArray(); // ['id' => 17923, 'firewall_group_id' => null, 'hostname' => '...', 'state' => 'running', ...]
}
```

#### Get Metrics

Retrieves historical performance metrics (CPU, RAM, Disk, Network, Uptime) for a VM within a specified time range.

```php
$virtualMachineId = 1268054;
$dateFrom = '2025-05-01T00:00:00Z';
$dateTo = '2025-06-01T00:00:00Z';
$metrics = $hostinger->vps()->virtualMachines()->getMetrics($virtualMachineId, $dateFrom, $dateTo);

if ($metrics->cpu_usage) {
    $metrics->cpu_usage->unit; // %
    $metrics->cpu_usage->usage; // {"1742269632": 1.45, ...} (Timestamp => Value)
    $metrics->cpu_usage->toArray(); // ['unit' => '%', 'usage' => [...]]
}
if ($metrics->ram_usage) {
    $metrics->ram_usage->unit; // bytes
    $metrics->ram_usage->usage; // {"1742269632": 554176512, ...}
    $metrics->ram_usage->toArray(); // ['unit' => 'bytes', 'usage' => [...]]
}
if ($metrics->disk_space) {
    $metrics->disk_space->unit; // "bytes"
    $metrics->disk_space->usage; // {"1742269632": 2620018688, ...}
    $metrics->disk_space->toArray(); // ['unit' => 'bytes', 'usage' => [...]]
}
if ($metrics->outgoing_traffic) {
    $metrics->outgoing_traffic->unit; // "bytes"
    $metrics->outgoing_traffic->usage; // {"1742269632": 784800, ...}
    $metrics->outgoing_traffic->toArray(); // ['unit' => 'bytes', 'usage' => [...]]
}
if ($metrics->incoming_traffic) {
    $metrics->incoming_traffic->unit; // "bytes"
    $metrics->incoming_traffic->usage; // {"1742269632": 8978400, ...}
    $metrics->incoming_traffic->toArray(); // ['unit' => 'bytes', 'usage' => [...]]
}
if ($metrics->uptime) {
    $metrics->uptime->unit; // "milliseconds"
    $metrics->uptime->usage; // {"1742269632": 455248, ...}
    $metrics->uptime->toArray(); // ['unit' => 'milliseconds', 'usage' => [...]]
}

$metrics->toArray(); // ['cpu_usage' => [...], 'ram_usage' => [...], ...]
```

#### Set Nameservers

Sets the DNS resolvers used by the virtual machine.

```php
$virtualMachineId = 1268054;
$data = [
    'ns1' => '4.3.2.1',
    'ns2' => '1.2.3.4',
];
$nameServer = $hostinger->vps()->virtualMachines()->setNameServers($virtualMachineId, $data);

$nameServer->id; // 8123712
$nameServer->name; // action_name
$nameServer->state->value; // success
$nameServer->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$nameServer->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$nameServer->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Set Panel Password

Sets the password for the control panel (if applicable to the OS template).

```php
$virtualMachineId = 1268054;
$data = [
    'password' => 'oMeNRustosIO',
];

$response = $hostinger->vps()->virtualMachines()->setPanelPassword($virtualMachineId, $data['password']);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Recreate Virtual Machine

Reinstalls the OS on a virtual machine. **All data will be lost!**

```php
$virtualMachineId = 1268054;
$data = [
    'template_id' => 1130,
    'password' => 'oMeNRustosIO',
    'post_install_script_id' => 6324,
];

$response = $hostinger->vps()->virtualMachines()->recreate($virtualMachineId, $data);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s');
$response->updated_at->format('Y-m-d H:i:s');

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Restart Virtual Machine

Restarts a virtual machine (equivalent to stop then start).

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->virtualMachines()->restart($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Set Root Password

Sets the root password for the virtual machine.

```php
$virtualMachineId = 1268054;
$data = [
    'password' => 'oMeNRustosIO',
];

$response = $hostinger->vps()->virtualMachines()->setRootPassword($virtualMachineId, $data['password']);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Setup New Virtual Machine

Sets up a newly purchased VPS (in `initial` state). Requires OS template and data center.

```php
$virtualMachineId = 1268054;
$data = [
    'template_id' => 1130,
    'data_center_id' => 19,
    'password' => 'oMeNRustosIO', // Optional
    'hostname' => 'my.server.tld', // Optional
    'install_monarx' => false, // Optional
    'enable_backups' => true, // Optional
    'ns1' => '4.3.2.1', // Optional
    'ns2' => '1.2.3.4', // Optional
    'post_install_script_id' => 6324, // Optional
    'public_key' => [
        'name' => 'my-key',
        'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC2X...',
    ]
];

$virtualMachine = $hostinger->vps()->virtualMachines()->setup($virtualMachineId, $data);

$virtualMachine->id; // 17923
$virtualMachine->firewall_group_id; // null
$virtualMachine->subscription_id; // Azz353Uhl1xC54pR0
$virtualMachine->plan; // KVM 4
$virtualMachine->hostname; // my.server.tld
$virtualMachine->state->value; // creating
$virtualMachine->actions_lock->value; // unlocked
$virtualMachine->cpus; // 4
$virtualMachine->memory; // 8192
$virtualMachine->disk; // 51200
$virtualMachine->bandwidth; // 1073741824
$virtualMachine->ns1; // 4.3.2.1
$virtualMachine->ns2; // 1.2.3.4
$virtualMachine->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

if ($virtualMachine->ipv4) {
    foreach ($virtualMachine->ipv4 as $ip4) {
        $ip4->id; // 52347
        $ip4->address; // 213.331.273.15
        $ip4->ptr; // something.domain.tld
        $ip4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
    }
}

if ($virtualMachine->ipv6) {
     foreach ($virtualMachine->ipv6 as $ip6) {
         $ip6->id; // 52347
         $ip6->address; // 2a00:4000:f:eaee::1
         $ip6->ptr; // something.domain.tld
         $ip6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
     }
}

if ($virtualMachine->template) {
    $virtualMachine->template->id; // 6523
    $virtualMachine->template->name; // Ubuntu 20.04 LTS
    $virtualMachine->template->description; // Ubuntu 20.04 LTS
    $virtualMachine->template->documentation; // https://docs.ubuntu.com
    $virtualMachine->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
}

$virtualMachine->toArray(); // ['id' => 17923, 'firewall_group_id' => null, 'hostname' => '...', 'state' => 'running', ...]
```

#### Start Virtual Machine

Starts a stopped virtual machine.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->virtualMachines()->start($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Stop Virtual Machine

Stops a running virtual machine.

```php
$virtualMachineId = 1268054;
$response = $hostinger->vps()->virtualMachines()->stop($virtualMachineId);

$response->id; // 8123712
$response->name; // action_name
$response->state->value; // success
$response->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$response->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$response->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

## Testing

Run the test suite using Pest:

```bash
composer test
```

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute, including coding standards, testing procedures, and guidelines for adding new features.

## Credits

- [Derrick Obedgiu](https://github.com/derrickobedgiu1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.
```