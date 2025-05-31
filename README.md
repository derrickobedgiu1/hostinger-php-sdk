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
    * [Availability](#availability)
      * [Check Domain Availability](#check-domain-availability)
    * [Forwarding](#forwarding)
      * [Get Forwarding Data](#get-forwarding-data)
      * [Delete Forwarding Data](#delete-forwarding-data)
      * [Create Forwarding Data](#create-forwarding-data)
    * [Portfolio](#portfolio)
      * [Enable Domain Lock](#enable-domain-lock)
      * [Disable Domain Lock](#disable-domain-lock)
      * [Get Domain](#get-domain)
      * [Get Domain List](#get-domain-list)
      * [Purchase New Domain](#purchase-new-domain)
      * [Enable Privacy Protection](#enable-privacy-protection)
      * [Disable Privacy Protection](#disable-privacy-protection)
      * [Update Nameservers](#update-nameservers)
    * [WHOIS](#whois)
      * [Get WHOIS Profile List](#get-whois-profile-list)
      * [Create WHOIS Profile](#create-whois-profile)
      * [Get WHOIS Profile](#get-whois-profile)
      * [Delete WHOIS Profile](#delete-whois-profile)
      * [Get WHOIS Profile Usage](#get-whois-profile-usage)
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
      * [Purchase New Virtual Machine](#purchase-new-virtual-machine)
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

Access domain-related features via `$hostinger->domains()`.

### Availability

Access domain availability checks via `$hostinger->domains()->availability()`.

#### Check Domain Availability

Checks the availability of a domain name across multiple TLDs. Can optionally return alternative suggestions.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-availability/POST/api/domains/v1/availability)

```php
$data = [
    'domain' => 'mydomain',
    'tlds' => ['com', 'net', 'org'],
    'with_alternatives' => false, // Optional: Set to true for suggestions
];

$results = $hostinger->domains()->availability()->check($data);

foreach ($results as $result) {
    $result->domain; // mydomain.com
    $result->is_available; // true
    $result->is_alternative; // false
    $result->restriction; // null

    $result->toArray(); // ['domain' => 'mydomain.com', 'is_available' => true, ...]
}
```

### Forwarding

Manage domain forwarding via `$hostinger->domains()->forwarding()`.

#### Get Forwarding Data

Retrieves domain forwarding data.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-forwarding/GET/api/domains/v1/forwarding/{domain})

```php
$domainName = "mydomain.tld";
$forwarding = $hostinger->domains()->forwarding()->get($domainName);

$forwarding->domain; // mydomain.tld
$forwarding->redirect_type; // 301
$forwarding->redirect_url; // https://forward.to.my.url
$forwarding->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$forwarding->updated_at?->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$forwarding->toArray(); // ['domain' => 'mydomain.tld', 'redirect_type' => '301', ...]
```

#### Delete Forwarding Data

Deletes domain forwarding data.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-forwarding/DELETE/api/domains/v1/forwarding/{domain})

```php
$domainName = "mydomain.tld";
$response = $hostinger->domains()->forwarding()->delete($domainName);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Create Forwarding Data

Creates domain forwarding data.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-forwarding/POST/api/domains/v1/forwarding)

```php
$data = [
    'domain' => 'mydomain.tld',
    'redirect_type' => '301', // '301' (Permanent) or '302' (Temporary)
    'redirect_url' => 'https://forward.to.my.url',
];

$forwarding = $hostinger->domains()->forwarding()->create($data);

$forwarding->domain; // mydomain.tld
$forwarding->redirect_type; // 301
$forwarding->redirect_url; // https://forward.to.my.url
$forwarding->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$forwarding->updated_at?->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$forwarding->toArray(); // ['domain' => 'mydomain.tld', 'redirect_type' => '301', ...]
```

### Portfolio

Manage your domain portfolio via `$hostinger->domains()->portfolio()`.

#### Enable Domain Lock

Enables the transfer lock for a domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/domain-lock)

```php
$domainName = "mydomain.tld";
$response = $hostinger->domains()->portfolio()->enableDomainLock($domainName);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Disable Domain Lock

Disables the transfer lock for a domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/DELETE/api/domains/v1/portfolio/{domain}/domain-lock)

```php
$domainName = "mydomain.tld";
$response = $hostinger->domains()->portfolio()->disableDomainLock($domainName);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Domain

Retrieves extended details for a specific domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/GET/api/domains/v1/portfolio/{domain})

```php
$domainName = "mydomain.tld";
$domainDetails = $hostinger->domains()->portfolio()->get($domainName);

$domainDetails->domain; // mydomain.tld
$domainDetails->status->value; // active
$domainDetails->message; // null
$domainDetails->is_privacy_protection_allowed; // true
$domainDetails->is_privacy_protected; // false
$domainDetails->is_lockable; // true
$domainDetails->is_locked; // true
$domainDetails->name_servers; // ['ns1' => 'ns1.example.tld', 'ns2' => 'ns2.example.tld']
$domainDetails->child_name_servers; // null or array
$domainDetails->domain_contacts; // ['admin_id' => 114698, ...]
$domainDetails->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$domainDetails->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22
$domainDetails->sixty_days_lock_expires_at?->format('Y-m-d H:i:s'); // 2025-04-26 11:54:22
$domainDetails->registered_at?->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$domainDetails->expires_at?->format('Y-m-d H:i:s'); // 2026-02-27 11:54:22

$domainDetails->toArray(); // ['domain' => 'mydomain.tld', 'status' => 'active', ...]
```

#### Get Domain List

Retrieves a list of all domains associated with your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/GET/api/domains/v1/portfolio)

```php
$domains = $hostinger->domains()->portfolio()->list();

foreach ($domains as $domain) {
    $domain->id; // 13632
    $domain->domain; // mydomain.tld or null
    $domain->type->value; // domain or free_domain
    $domain->status->value; // active, pending_setup, expired, requested, pending_verification
    $domain->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $domain->expires_at?->format('Y-m-d H:i:s'); // 2026-02-27 11:54:22

    $domain->toArray(); // ['id' => 13632, 'domain' => 'mydomain.tld', ...]
}
```

#### Purchase New Domain

Purchases and registers a new domain name.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/POST/api/domains/v1/portfolio)

```php
$data = [
    'domain' => 'mynewdomain.tld',
    'item_id' => 'hostingercom-domain-tld-usd-1y', // Price Item ID from Catalog
    'payment_method_id' => 1327362, // Optional: Uses default if omitted
    'domain_contacts' => [ // Optional: Uses default TLD contacts if omitted
        'owner_id' => 741288,
        'admin_id' => 546123,
        'billing_id' => 741288,
        'tech_id' => 741288,
    ],
    'additional_details' => [], // optional
    'coupons' => ['Coupon 3'], // optional: discount coupon codes
];

$order = $hostinger->domains()->portfolio()->purchase($data);

$order->id; // 2957086
$order->status->value; // completed
$order->currency; // USD
$order->subtotal; // 899 (cents)
$order->total; // 1088 (cents)

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
$order->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

$order->toArray(); // ['id' => 2957086, 'subscription_id' => '...', 'status' => 'completed', 'billing_address' => [...], ...]
```

#### Enable Privacy Protection

Enables WHOIS privacy protection for a domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/privacy-protection)

```php
$domainName = "mydomain.tld";
$response = $hostinger->domains()->portfolio()->enablePrivacyProtection($domainName);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Disable Privacy Protection

Disables WHOIS privacy protection for a domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/DELETE/api/domains/v1/portfolio/{domain}/privacy-protection)

```php
$domainName = "mydomain.tld";
$response = $hostinger->domains()->portfolio()->disablePrivacyProtection($domainName);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Update Nameservers

Updates the nameservers for a domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-portfolio/PUT/api/domains/v1/portfolio/{domain}/nameservers)

```php
$domainName = "mydomain.tld";
$data = [
    'ns1' => 'ns1.some-nameserver.tld',
    'ns2' => 'ns2.some-nameserver.tld',
    'ns3' => 'ns3.some-nameserver.tld', // optional
    'ns4' => 'ns4.some-nameserver.tld', // optional
];

$response = $hostinger->domains()->portfolio()->updateNameservers($domainName, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

### WHOIS

Manage WHOIS contact profiles via `$hostinger->domains()->whois()`.

#### Get WHOIS Profile List

Retrieves a list of WHOIS contact profiles. Can be filtered by TLD.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois)

```php
// Get all profiles
$profiles = $hostinger->domains()->whois()->list();

// Get profiles for '.com' TLD
$comProfiles = $hostinger->domains()->whois()->list(['tld' => 'com']);

foreach ($profiles as $profile) {
    $profile->id; // 746263
    $profile->tld; // com
    $profile->country; // NL
    $profile->entity_type; // individual
    $profile->whois_details; // ['first_name' => 'John', ...]
    $profile->tld_details; // null or array
    $profile->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $profile->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

    $profile->toArray(); // ['id' => 746263, 'tld' => 'com', ...]
}
```

#### Create WHOIS Profile

Creates a new WHOIS contact profile.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-whois/POST/api/domains/v1/whois)

```php
$data = [
    'tld' => 'com',
    'entity_type' => 'individual', // or 'organization'
    'country' => 'US', // ISO 3166 2-letter code
    'whois_details' => [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'email' => 'jane@doe.tld',
        'phone' => '+1.1234567890',
        'address1' => '123 Main St',
        'city' => 'Anytown',
        'state' => 'CA',
        'zip' => '90210',
        // ...
    ],
    'tld_details' => [], // optional
];

$newProfile = $hostinger->domains()->whois()->create($data);

$newProfile->id; // 746264
$newProfile->tld; // com
$newProfile->country; // US
$newProfile->entity_type; // individual
$newProfile->whois_details; // ['first_name' => 'Jane', ...]
$newProfile->tld_details; // []
$newProfile->created_at->format('Y-m-d H:i:s'); // 2025-04-01 10:00:00
$newProfile->updated_at->format('Y-m-d H:i:s'); // 2025-04-01 10:00:00

$newProfile->toArray();
```

#### Get WHOIS Profile

Retrieves details for a specific WHOIS profile.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois/{whoisId})

```php
$whoisId = 746263;
$profile = $hostinger->domains()->whois()->get($whoisId);

$profile->id; // 746263
$profile->tld; // com
$profile->country; // NL
$profile->entity_type; // individual
$profile->whois_details; // ['first_name' => 'John', ...]
$profile->tld_details; // null
$profile->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$profile->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$profile->toArray();
```

#### Delete WHOIS Profile

Deletes a WHOIS contact profile.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-whois/DELETE/api/domains/v1/whois/{whoisId})

```php
$whoisId = 746263;
$response = $hostinger->domains()->whois()->delete($whoisId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get WHOIS Profile Usage

Retrieves a list of domains currently using a specific WHOIS profile.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/domains-whois/GET/api/domains/v1/whois/{whoisId}/usage)

```php
$whoisId = 746263;
$usage = $hostinger->domains()->whois()->getUsage($whoisId);

$usage->domains; // ['mydomain1.tld', 'mydomain2.tld']

$usage->toArray(); // ['mydomain1.tld', 'mydomain2.tld']
```

## DNS

Access DNS features via `$hostinger->dns()`.

### Snapshot

Manage DNS snapshots via `$hostinger->dns()->snapshots()`.

#### Get Snapshot

Retrieves a specific DNS snapshot with its content.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-snapshot/GET/api/dns/v1/snapshots/{domain}/{snapshotId})

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
         $recordValue->is_disabled; // false
    }
}

$snapshot->toArray(); // ['id' => 53513053, 'reason' => '...', 'snapshot' => [[...], ...], 'created_at' => ...]
```

#### Restore Snapshot

Restores a domain's DNS zone to the state captured in a selected snapshot.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-snapshot/POST/api/dns/v1/snapshots/{domain}/{snapshotId}/restore)

```php
$domainName = "mydomain.tld";
$snapshotId = 53513053;
$response = $hostinger->dns()->snapshots()->restore($domainName, $snapshotId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Snapshot List

Retrieves a list of DNS snapshots for a specific domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-snapshot/GET/api/dns/v1/snapshots/{domain})

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

Manage DNS zones and records via `$hostinger->dns()->zones()`.

#### Get Records

Retrieves all DNS records for a specific domain.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-zone/GET/api/dns/v1/zones/{domain})

```php
$domainName = "mydomain.tld";
$recordGroups = $hostinger->dns()->zones()->getRecords($domainName);

foreach ($recordGroups as $group) {
    $group->name; // www
    $group->type; // A
    $group->ttl; // 14400

    foreach ($group->records as $recordValue) {
        $recordValue->content; // mydomain.tld.
        $recordValue->is_disabled; // false
        $recordValue->toArray(); // ['content' => '...', 'is_disabled' => false]
    }

    $group->toArray(); // ['name' => 'www', 'records' => [[...], ...], 'ttl' => 14400, 'type' => 'A']
}
```

#### Update Zone Records

Updates DNS records for the selected domain. Using `overwrite = true` (default) replaces records; otherwise, appends or updates TTLs.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-zone/PUT/api/dns/v1/zones/{domain})

```php
$domainName = "mydomain.tld";
$data = [
    'overwrite' => true, // Optional, default: true
    'zone' => [
        [
            'name' => 'www', // Use '@' for root domain
            'records' => [['content' => '192.0.2.1']], // Array of record values
            'ttl' => 3600, // Optional, default TTL applies if omitted
            'type' => 'A', // A, AAAA, CNAME, ALIAS, MX, TXT, NS, SOA, SRV, CAA
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

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-zone/DELETE/api/dns/v1/zones/{domain})

```php
$domainName = "mydomain.tld";
$data = [
    'filters' => [
        ['name' => '@', 'type' => 'A'], // Delete all A records for the root domain
        ['name' => 'www', 'type' => 'CNAME'], // Delete www CNAME record
    ],
];

$response = $hostinger->dns()->zones()->delete($domainName, $data);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Validate Zone Records

Validates DNS records before attempting an update. Throws a `ValidationException` if invalid.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-zone/POST/api/dns/v1/zones/{domain}/validate)

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
    echo "Validation failed: " . $e->getMessage() . "\n";
    print_r($e->getErrors());
}
```

#### Reset Zone Records

Resets the DNS zone for a domain to the default Hostinger records.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/dns-zone/POST/api/dns/v1/zones/{domain}/reset)

```php
$domainName = "mydomain.tld";

// Reset with defaults (sync=true, reset_email_records=true)
$response = $hostinger->dns()->zones()->reset($domainName);
$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']

// Reset with options
$data = [
    'sync' => true, // Optional
    'reset_email_records' => false, // Optional
    'whitelisted_record_types' => ['MX', 'TXT'], // Optional. Specify record types not to reset.
];
$response = $hostinger->dns()->zones()->reset($domainName, $data);
$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']

```

## Billing

Access billing features via `$hostinger->billing()`.

### Catalog

Access the service catalog via `$hostinger->billing()->catalog()`.

#### Get Catalog Item List

Retrieves a list of catalog items available for order. Prices are in cents. Can be filtered.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-catalog/GET/api/billing/v1/catalog)

```php
// Get all items
$catalogs = $hostinger->billing()->catalog()->list();

// Get only VPS items
$vpsCatalogs = $hostinger->billing()->catalog()->list(['category' => 'VPS']);

// Get only .COM domain items
$comCatalogs = $hostinger->billing()->catalog()->list(['name' => '.COM*']);

foreach ($catalogs as $catalog) {
    $catalog->id; // hostingercom-vps-kvm2
    $catalog->name; // KVM 2
    $catalog->category; // VPS

    foreach ($catalog->prices as $price) {
        $price->id; // hostingercom-vps-kvm2-usd-1m
        $price->name; // KVM 2 (billed every month)
        $price->currency; // USD
        $price->price; // 1799 (cents)
        $price->first_period_price; // 899 (cents)
        $price->period; // 1
        $price->period_unit->value; // month, year, day, week, none

        $price->toArray(); // ['id' => '...', 'name' => '...', 'currency' => 'USD', ...]
    }

    $catalog->toArray(); // ['id' => '...', 'name' => 'KVM 2', 'category' => 'VPS', 'prices' => [[...], ...]]
}
```

### Orders

Manage service orders via `$hostinger->billing()->orders()`.

#### Create New Service Order

Creates a new service order. Requires a payment method ID and catalog item price IDs. Orders created via API are set for auto-renewal. Prices are in cents.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-orders/POST/api/billing/v1/orders)

```php
$data = [
    'payment_method_id' => 517244,
    'items' => [
        [
            'item_id' => 'hostingercom-vps-kvm2-usd-1m', // Price ID from Catalog
            'quantity' => 1,
        ],
    ],
    'coupons' => ['Coupon 3'], // optional
];

$order = $hostinger->billing()->orders()->create($data);

$order->id; // 2957086
$order->subscription_id; // Azz353Uhl1xC54pR0
$order->status->value; // completed, pending, processing, failed, etc.
$order->currency; // USD
$order->subtotal; // 899 (cents)
$order->total; // 1088 (cents)

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
$order->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

$order->toArray(); // ['id' => 2957086, 'subscription_id' => '...', 'status' => 'completed', 'billing_address' => [...], ...]
```

### Payment Methods

Manage payment methods via `$hostinger->billing()->paymentMethods()`.

#### Set Default Payment Method

Sets a specific payment method as the default for your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-payment-methods/POST/api/billing/v1/payment-methods/{paymentMethodId})

```php
$paymentMethodId = 9693613;
$response = $hostinger->billing()->paymentMethods()->setDefault($paymentMethodId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Delete Payment Method

Deletes a payment method from your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-payment-methods/DELETE/api/billing/v1/payment-methods/{paymentMethodId})

```php
$paymentMethodId = 9693613;
$response = $hostinger->billing()->paymentMethods()->delete($paymentMethodId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Payment Method List

Retrieves available payment methods linked to your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-payment-methods/GET/api/billing/v1/payment-methods)

```php
$paymentMethods = $hostinger->billing()->paymentMethods()->list();

foreach ($paymentMethods as $paymentMethod) {
    $paymentMethod->id; // 6523
    $paymentMethod->name; // Credit Card
    $paymentMethod->identifier; // 1234*****6464
    $paymentMethod->payment_method->value; // card, paypal, googlepay
    $paymentMethod->is_default; // true
    $paymentMethod->is_expired; // false
    $paymentMethod->is_suspended; // false
    $paymentMethod->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $paymentMethod->expires_at?->format('Y-m-d H:i:s'); // 2028-03-31 00:00:00

    $paymentMethod->toArray(); // ['id' => 6523, 'name' => 'Credit Card', 'identifier' => '...', 'payment_method' => 'card', ...]
}
```

### Subscriptions

Manage service subscriptions via `$hostinger->billing()->subscriptions()`.

#### Cancel Subscription

Cancels a subscription and stops further billing.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-subscriptions/DELETE/api/billing/v1/subscriptions/{subscriptionId})

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


// Cancel at the end of the term (default behavior if $data is empty or omitted)
$response = $hostinger->billing()->subscriptions()->cancel($subscriptionId);
$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Subscription List

Retrieves all subscriptions associated with your account. Prices are in cents.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/billing-subscriptions/GET/api/billing/v1/subscriptions)

```php
$subscriptions = $hostinger->billing()->subscriptions()->list();

foreach ($subscriptions as $subscription) {
    $subscription->id; // Azz36nUfKX1S1MSF
    $subscription->name; // KVM 1
    $subscription->status->value; // active, paused, cancelled, not_renewing, transferred, in_trial, future
    $subscription->billing_period; // 1
    $subscription->billing_period_unit->value; // day, week, month, year, none
    $subscription->currency_code; // USD
    $subscription->total_price; // 1799 (cents)
    $subscription->renewal_price; // 1799 (cents)
    $subscription->is_auto_renewed; // true
    $subscription->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $subscription->expires_at?->format('Y-m-d H:i:s'); // 2026-02-27 11:54:22
    $subscription->next_billing_at?->format('Y-m-d H:i:s'); // 2025-03-27 11:54:22

    $subscription->toArray(); // ['id' => '...', 'name' => 'KVM 1', 'status' => 'active', 'is_auto_renewed' => true, ...]
}
```

## VPS

Access Virtual Private Server features via `$hostinger->vps()`.

### Actions

View VM action history via `$hostinger->vps()->actions()`.

#### Get Action

Retrieves details for a specific action performed on a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions/{actionId})

```php
$virtualMachineId = 1268054;
$actionId = 8123712;
$action = $hostinger->vps()->actions()->get($virtualMachineId, $actionId);

$action->id; // 8123712
$action->name; // action_name (e.g., start, stop, create_snapshot)
$action->state->value; // success, error, delayed, sent, created
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
```

#### Get Action List

Retrieves a paginated list of actions performed on a specific VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-actions/GET/api/vps/v1/virtual-machines/{virtualMachineId}/actions)

```php
$virtualMachineId = 1268054;
$actionsPage = $hostinger->vps()->actions()->list($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$actionsPage->getCurrentPage(); // 1
$actionsPage->getPerPage(); // 15
$actionsPage->getTotal(); // 100

foreach ($actionsPage->getData() as $action) {
    $action->id; // 8123712
    $action->name; // action_name
    $action->state->value; // success
    $action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
    $action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

    $action->toArray(); // ['id' => 8123712, 'name' => 'action_name', 'state' => 'success', ...]
}

$actionsPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

### Backups

Manage VM backups via `$hostinger->vps()->backups()`.

#### Delete Backup

Deletes a specific backup.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-backups/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId})

```php
$virtualMachineId = 1268054;
$backupId = 8676502;
$response = $hostinger->vps()->backups()->delete($virtualMachineId, $backupId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Backup List

Retrieves a paginated list of backups for a specific virtual machine.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-backups/GET/api/vps/v1/virtual-machines/{virtualMachineId}/backups)

```php
$virtualMachineId = 1268054;
$backupsPage = $hostinger->vps()->backups()->list($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$backupsPage->getCurrentPage(); // 1
$backupsPage->getPerPage(); // 15
$backupsPage->getTotal(); // 100

foreach ($backupsPage->getData() as $backup) {
    $backup->id; // 325
    $backup->location; // nl-srv-openvzbackups
    $backup->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22

    $backup->toArray(); // ['id' => 325, 'location' => 'nl-srv-openvzbackups', 'created_at' => ...]
}

$backupsPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Restore Backup

Restores a VM to the state of a specific backup. **Warning: Overwrites current VM data!**

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-backups/POST/api/vps/v1/virtual-machines/{virtualMachineId}/backups/{backupId}/restore)

```php
$virtualMachineId = 1268054;
$backupId = 8676502;
$action = $hostinger->vps()->backups()->restore($virtualMachineId, $backupId);

$action->id; // 8123712
$action->name; // restore_backup
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123712, 'name' => 'restore_backup', 'state' => 'success', ...]
```

### Data Centers

Access data center information via `$hostinger->vps()->dataCenters()`.

#### Get Data Centers List

Retrieves a list of all available Hostinger data centers where VPS can be deployed.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-data-centers/GET/api/vps/v1/data-centers)

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

Manage reverse DNS (PTR) records via `$hostinger->vps()->ptrRecords()`.

#### Create PTR Record

Creates or updates the PTR (reverse DNS) record for a VM's primary IP, pointing to the VM's hostname.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-ptr-records/POST/api/vps/v1/virtual-machines/{virtualMachineId}/ptr)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->ptrRecords()->create($virtualMachineId);

$action->id; // 8123728
$action->name; // create_ptr_record
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123728, 'name' => 'create_ptr_record', 'state' => 'success', ...]
```

#### Delete PTR Record

Deletes the PTR record for a VM's primary IP.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-ptr-records/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/ptr)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->ptrRecords()->delete($virtualMachineId);

$action->id; // 8123729
$action->name; // delete_ptr_record
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123729, 'name' => 'delete_ptr_record', 'state' => 'success', ...]
```

### Firewall

Manage network firewalls via `$hostinger->vps()->firewalls()`. Access requires at least one VPS.

#### Activate Firewall

Activates a firewall for a specific VM. Only one firewall can be active per VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/activate/{virtualMachineId})

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$action = $hostinger->vps()->firewalls()->activate($firewallId, $virtualMachineId);

$action->id; // 8123715
$action->name; // activate_firewall
$action->state->value; // sent
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123715, 'name' => 'activate_firewall', 'state' => 'sent', ...]
```

#### Deactivate Firewall

Deactivates the currently active firewall for a specific VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/deactivate/{virtualMachineId})

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$action = $hostinger->vps()->firewalls()->deactivate($firewallId, $virtualMachineId);

$action->id; // 8123716
$action->name; // deactivate_firewall
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123716, 'name' => 'deactivate_firewall', 'state' => 'success', ...]
```

#### Get Firewall

Retrieves details for a specific firewall, including its rules.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/GET/api/vps/v1/firewall/{firewallId})

```php
$firewallId = 9449049;
$firewall = $hostinger->vps()->firewalls()->get($firewallId);

$firewall->id; // 65224
$firewall->name; // HTTP and SSH only
$firewall->is_synced; // false
$firewall->created_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00
$firewall->updated_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00

foreach ($firewall->rules as $rule) {
    $rule->id; // 24541
    $rule->action->value; // accept, drop
    $rule->protocol->value; // TCP, UDP, ICMP, ANY, SSH, HTTP, HTTPS, etc.
    $rule->port; // e.g., "443", "1024:2048"
    $rule->source->value; // any, custom
    $rule->source_detail; // e.g., "any", "192.168.1.1", "10.0.0.0/8"

    $rule->toArray(); // ['id' => 24541, 'action' => 'accept', 'protocol' => 'TCP', ...]
}

$firewall->toArray(); // ['id' => 65224, 'name' => '...', 'is_synced' => false, 'rules' => [...], ...]
```

#### Delete Firewall

Deletes a firewall. Any VMs using it will have the firewall deactivated.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/DELETE/api/vps/v1/firewall/{firewallId})

```php
$firewallId = 9449049;
$response = $hostinger->vps()->firewalls()->delete($firewallId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Firewall List

Retrieves a paginated list of all firewalls available in your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/GET/api/vps/v1/firewall)

```php
$firewallsPage = $hostinger->vps()->firewalls()->list(['page' => 1]);

// Access pagination metadata
$firewallsPage->getCurrentPage(); // 1
$firewallsPage->getPerPage(); // 15
$firewallsPage->getTotal(); // 100

foreach ($firewallsPage->getData() as $firewall) {
    $firewall->id; // 65224
    $firewall->name; // HTTP and SSH only
    $firewall->is_synced; // false
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

    $firewall->toArray(); // ['id' => 65224, 'name' => '...', 'is_synced' => false, 'rules' => [[...], ...], ...]
}

$firewallsPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create New Firewall

Creates a new, empty firewall group.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall)

```php
$data = [
    'name' => 'My New Firewall',
];

$firewall = $hostinger->vps()->firewalls()->create($data);

$firewall->id; // 65225
$firewall->name; // My New Firewall
$firewall->is_synced; // true (initially synced as it's not attached)
$firewall->rules; // [] (empty array)
$firewall->created_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00
$firewall->updated_at->format('Y-m-d H:i:s'); // 2021-09-01 12:00:00

$firewall->toArray(); // ['id' => 65225, 'name' => 'My New Firewall', 'is_synced' => true, 'rules' => [], ...]
```

#### Update Firewall Rule

Updates an existing rule within a firewall. The firewall becomes unsynced if attached to VMs.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/PUT/api/vps/v1/firewall/{firewallId}/rules/{ruleId})

```php
$firewallId = 9449049;
$ruleId = 8941182;
$data = [
    'protocol' => 'UDP', // TCP, UDP, ICMP, ANY, SSH, HTTP, HTTPS, etc.
    'port' => '53', // Port or range "1024:2048"
    'source' => 'custom', // any, custom
    'source_detail' => '1.1.1.1', // IP, CIDR, or 'any'
    'action' => 'accept', // accept, drop
];

$rule = $hostinger->vps()->firewalls()->updateRule($firewallId, $ruleId, $data);

$rule->id; // 8941182
$rule->action->value; // accept
$rule->protocol->value; // UDP
$rule->port; // 53
$rule->source->value; // custom
$rule->source_detail; // 1.1.1.1

$rule->toArray(); // ['id' => 8941182, 'action' => 'accept', 'protocol' => 'UDP', ...]
```

#### Delete Firewall Rule

Deletes a specific rule from a firewall. The firewall becomes unsynced if attached to VMs.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/DELETE/api/vps/v1/firewall/{firewallId}/rules/{ruleId})

```php
$firewallId = 9449049;
$ruleId = 8941182;
$response = $hostinger->vps()->firewalls()->deleteRule($firewallId, $ruleId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Create Firewall Rule

Adds a new rule to an existing firewall. The firewall becomes unsynced if attached to VMs.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/rules)

```php
$firewallId = 9449049;
$data = [
    'protocol' => 'TCP',
    'port' => '443',
    'source' => 'any', // 'any' or 'custom'
    'source_detail' => 'any', // IP, CIDR, or 'any'
    'action' => 'accept', // 'accept' or 'drop'
];

$rule = $hostinger->vps()->firewalls()->createRule($firewallId, $data);

$rule->id; // 8941183
$rule->action->value; // accept
$rule->protocol->value; // TCP
$rule->port; // 443
$rule->source->value; // any
$rule->source_detail; // any

$rule->toArray(); // ['id' => 8941183, 'action' => 'accept', 'protocol' => 'TCP', ...]
```

#### Sync Firewall

Syncs firewall rules to an attached VM if the firewall is marked as unsynced (e.g., after rule changes).

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-firewall/POST/api/vps/v1/firewall/{firewallId}/sync/{virtualMachineId})

```php
$firewallId = 9449049;
$virtualMachineId = 1268054;
$action = $hostinger->vps()->firewalls()->sync($firewallId, $virtualMachineId);

$action->id; // 8123717
$action->name; // sync_firewall
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123717, 'name' => 'sync_firewall', 'state' => 'success', ...]
```

### Malware Scanner

Manage the Monarx malware scanner via `$hostinger->vps()->malwareScanner()`.

#### Get Scan Metrics

Retrieves the latest Monarx malware scan metrics for a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-malware-scanner/GET/api/vps/v1/virtual-machines/{virtualMachineId}/monarx)

```php
$virtualMachineId = 1268054;
$metrics = $hostinger->vps()->malwareScanner()->getMetrics($virtualMachineId);

$metrics->records; // 1
$metrics->malicious; // 2
$metrics->compromised; // 3
$metrics->scanned_files; // 193218
$metrics->scan_started_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$metrics->scan_ended_at?->format('Y-m-d H:i:s'); // 2025-02-27 12:10:00

$metrics->toArray(); // ['records' => 1, 'malicious' => 2, 'compromised' => 3, ...]
```

#### Install Monarx

Installs the Monarx malware scanner on a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-malware-scanner/POST/api/vps/v1/virtual-machines/{virtualMachineId}/monarx)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->malwareScanner()->install($virtualMachineId);

$action->id; // 8123718
$action->name; // install_monarx
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123718, 'name' => 'install_monarx', 'state' => 'success', ...]
```

#### Uninstall Monarx

Uninstalls the Monarx malware scanner from a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-malware-scanner/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/monarx)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->malwareScanner()->uninstall($virtualMachineId);

$action->id; // 8123719
$action->name; // uninstall_monarx
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123719, 'name' => 'uninstall_monarx', 'state' => 'success', ...]
```

### OS Templates

Access available OS templates via `$hostinger->vps()->templates()`.

#### Get Template

Retrieves details for a specific OS template.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates/{templateId})

```php
$templateId = 2868928;
$template = $hostinger->vps()->templates()->get($templateId);

$template->id; // 2868928
$template->name; // Ubuntu 20.04 LTS
$template->description; // Ubuntu 20.04 LTS
$template->documentation; // https://docs.ubuntu.com or null

$template->toArray(); // ['id' => 2868928, 'name' => '...', 'description' => '...', 'documentation' => null]
```

#### Get Template List

Retrieves a list of available OS templates for installing on virtual machines.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates)

```php
$templates = $hostinger->vps()->templates()->list();

foreach ($templates as $template) {
    $template->id; // 6523
    $template->name; // Ubuntu 20.04 LTS
    $template->description; // Ubuntu 20.04 LTS
    $template->documentation; // https://docs.ubuntu.com or null

    $template->toArray(); // ['id' => 6523, 'name' => 'Ubuntu 20.04 LTS', 'description' => '...', 'documentation' => '...']
}
```

### Post-Install Scripts

Manage scripts to run after OS installation via `$hostinger->vps()->postInstallScripts()`.

#### Get Post-Install Script

Retrieves details of a specific post-install script.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-post-install-scripts/GET/api/vps/v1/post-install-scripts/{postInstallScriptId})

```php
$postInstallScriptId = 9568314;
$script = $hostinger->vps()->postInstallScripts()->get($postInstallScriptId);

$script->id; // 325
$script->name; // My Setup Script
$script->content; // #!/bin/bash\napt-get update...
$script->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$script->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

$script->toArray(); // ['id' => 325, 'name' => '...', 'content' => '...', 'created_at' => ..., 'updated_at' => ...]
```

#### Update Post-Install Script

Updates the name and/or content of an existing post-install script.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-post-install-scripts/PUT/api/vps/v1/post-install-scripts/{postInstallScriptId})

```php
$postInstallScriptId = 9568314;
$data = [
    'name' => 'Updated Setup Script',
    'content' => "#!/bin/bash\napt-get update && apt-get upgrade -y",
];

$script = $hostinger->vps()->postInstallScripts()->update($postInstallScriptId, $data);

$script->id; // 9568314
$script->name; // Updated Setup Script
$script->content; // "#!/bin/bash\napt-get update && apt-get upgrade -y"
$script->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
$script->updated_at->format('Y-m-d H:i:s'); // 2025-04-01 10:30:00 (updated time)

$script->toArray(); // ['id' => 9568314, 'name' => 'Updated Setup Script', ...]
```

#### Delete a Post-Install Script

Deletes a post-install script from your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-post-install-scripts/DELETE/api/vps/v1/post-install-scripts/{postInstallScriptId})

```php
$postInstallScriptId = 9568314;
$response = $hostinger->vps()->postInstallScripts()->delete($postInstallScriptId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Post-Install Script List

Retrieves a paginated list of post-install scripts associated with your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-post-install-scripts/GET/api/vps/v1/post-install-scripts)

```php
$scriptsPage = $hostinger->vps()->postInstallScripts()->list(['page' => 1]);

// Access pagination metadata
$scriptsPage->getCurrentPage(); // 1
$scriptsPage->getPerPage(); // 15
$scriptsPage->getTotal(); // 100

foreach ($scriptsPage->getData() as $script) {
    $script->id; // 325
    $script->name; // "My Setup Script"
    $script->content; // "#!/bin/bash\napt-get update\napt-get install -y nginx"
    $script->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
    $script->updated_at->format('Y-m-d H:i:s'); // 2025-03-19 11:54:22

    $script->toArray(); // ['id' => 325, 'name' => 'My Setup Script', 'content' => '...', ...]
}

$scriptsPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create Post-Install Script

Creates a new script that can be run after OS installation on a VM. Max size 48KB.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-post-install-scripts/POST/api/vps/v1/post-install-scripts)

```php
$data = [
    'name' => 'Install Docker Script',
    'content' => "#!/bin/bash\napt-get update\napt-get install -y docker.io",
];
$script = $hostinger->vps()->postInstallScripts()->create($data);

$script->id; // 326
$script->name; // Install Docker Script
$script->content; // "#!/bin/bash\napt-get update\napt-get install -y docker.io"
$script->created_at->format('Y-m-d H:i:s'); // 2025-04-01 10:00:00
$script->updated_at->format('Y-m-d H:i:s'); // 2025-04-01 10:00:00

$script->toArray(); // ['id' => 326, 'name' => 'Install Docker Script', 'content' => '...', ...]
```

### Public Keys

Manage SSH public keys via `$hostinger->vps()->publicKeys()`.

#### Attach Public Key

Attaches existing public keys from your account to a specific VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-public-keys/POST/api/vps/v1/public-keys/attach/{virtualMachineId})

```php
$virtualMachineId = 1268054;
$data = [
    'ids' => [18232, 10230230], // Array of Public Key IDs
];

$action = $hostinger->vps()->publicKeys()->attach($virtualMachineId, $data);

$action->id; // 8123720
$action->name; // attach_public_key
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123720, 'name' => 'attach_public_key', 'state' => 'success', ...]
```

#### Delete a Public Key

Deletes a public key from your account. This does *not* remove it from VMs it's already attached to.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-public-keys/DELETE/api/vps/v1/public-keys/{publicKeyId})

```php
$publicKeyId = 6672861;
$response = $hostinger->vps()->publicKeys()->delete($publicKeyId);

$response->message; // Request accepted
$response->toArray(); // ['message' => 'Request accepted']
```

#### Get Public Key List

Retrieves a paginated list of SSH public keys associated with your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-public-keys/GET/api/vps/v1/public-keys)

```php
$keysPage = $hostinger->vps()->publicKeys()->list(['page' => 1]);

// Access pagination metadata
$keysPage->getCurrentPage(); // 1
$keysPage->getPerPage(); // 15
$keysPage->getTotal(); // 100

foreach ($keysPage->getData() as $key) {
    $key->id; // 325
    $key->name; // My public key
    $key->key; // ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD...

    $key->toArray(); // ['id' => 325, 'name' => 'My public key', 'key' => 'ssh-rsa...']
}

$keysPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Create New Public Key

Adds a new SSH public key to your account, which can then be attached to VMs.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-public-keys/POST/api/vps/v1/public-keys)

```php
$data = [
    'name' => 'My Laptop Key',
    'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAA...',
];

$publicKey = $hostinger->vps()->publicKeys()->create($data);

$publicKey->id; // 326
$publicKey->name; // My Laptop Key
$publicKey->key; // ssh-rsa AAAAB3NzaC1yc2EAAA...

$publicKey->toArray(); // ['id' => 326, 'name' => 'My Laptop Key', 'key' => 'ssh-rsa...']
```

### Recovery

Manage VM recovery mode via `$hostinger->vps()->recovery()`.

#### Start Recovery Mode

Boots a VM into a temporary recovery environment with the specified root password. The original disk is mounted at `/mnt`.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-recovery/POST/api/vps/v1/virtual-machines/{virtualMachineId}/recovery)

```php
$virtualMachineId = 1268054;
$data = [
    'root_password' => 'TemporarySecurePassword123!',
];

$action = $hostinger->vps()->recovery()->start($virtualMachineId, $data);

$action->id; // 8123721
$action->name; // start_recovery
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123721, 'name' => 'start_recovery', 'state' => 'success', ...]
```

#### Stop Recovery Mode

Boots the VM back into its normal operating system from recovery mode.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-recovery/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/recovery)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->recovery()->stop($virtualMachineId);

$action->id; // 8123722
$action->name; // stop_recovery
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123722, 'name' => 'stop_recovery', 'state' => 'success', ...]
```

### Snapshots

Manage VM snapshots via `$hostinger->vps()->snapshots()`. Note: Only one snapshot is kept per VM.

#### Get Snapshot

Retrieves information about the current snapshot for a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-snapshots/GET/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot)

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

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->snapshots()->create($virtualMachineId);

$action->id; // 8123732
$action->name; // create_snapshot
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123732, 'name' => 'create_snapshot', 'state' => 'success', ...]
```

#### Delete Snapshot

Deletes the existing snapshot for a VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-snapshots/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->snapshots()->delete($virtualMachineId);

$action->id; // 8123733
$action->name; // delete_snapshot
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123733, 'name' => 'delete_snapshot', 'state' => 'success', ...]
```

#### Restore Snapshot

Restores a VM to the state of its existing snapshot. **Warning: Overwrites current VM data!**

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-snapshots/POST/api/vps/v1/virtual-machines/{virtualMachineId}/snapshot/restore)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->snapshots()->restore($virtualMachineId);

$action->id; // 8123734
$action->name; // restore_snapshot
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123734, 'name' => 'restore_snapshot', 'state' => 'success', ...]
```

### Virtual Machine

Manage core VM operations via `$hostinger->vps()->virtualMachines()`.

#### Get Attached Public Keys

Retrieves a paginated list of SSH public keys attached to a specific virtual machine.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}/public-keys)

```php
$virtualMachineId = 1268054;
$keysPage = $hostinger->vps()->virtualMachines()->getAttachedPublicKeys($virtualMachineId, ['page' => 1]);

// Access pagination metadata
$keysPage->getCurrentPage(); // 1
$keysPage->getPerPage(); // 15
$keysPage->getTotal(); // 100

foreach ($keysPage->getData() as $key) {
    $key->id; // 325
    $key->name; // My public key
    $key->key; // ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQD...

    $key->toArray(); // ['id' => 325, 'name' => 'My public key', 'key' => 'ssh-rsa...']
}

$keysPage->toArray(); // ['data' => [[...], ...], 'meta' => ['current_page' => 1, ...]]
```

#### Set Hostname

Sets the hostname for a virtual machine. Does not automatically update PTR record.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/hostname)

```php
$virtualMachineId = 1268054;
$newHostname = 'my.new-server.tld';
$action = $hostinger->vps()->virtualMachines()->setHostName($virtualMachineId, $newHostname);

$action->id; // 8123723
$action->name; // set_hostname
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123723, 'name' => 'set_hostname', 'state' => 'success', ...]
```

#### Reset Hostname

Resets the hostname and PTR record to the default value (e.g., srvXXXXX.hstgr.cloud).

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/DELETE/api/vps/v1/virtual-machines/{virtualMachineId}/hostname)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->virtualMachines()->resetHostName($virtualMachineId);

$action->id; // 8123724
$action->name; // reset_hostname
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123724, 'name' => 'reset_hostname', 'state' => 'success', ...]
```

#### Get Virtual Machine

Retrieves detailed information for a specific virtual machine.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId})

```php
$virtualMachineId = 1268054;
$vm = $hostinger->vps()->virtualMachines()->get($virtualMachineId);

$vm->id; // 17923
$vm->firewall_group_id; // null or ID
$vm->subscription_id; // Azz353Uhl1xC54pR0
$vm->plan; // KVM 4
$vm->hostname; // srv17923.hstgr.cloud
$vm->state->value; // running, stopped, creating, initial, error, etc.
$vm->actions_lock->value; // unlocked, locked
$vm->cpus; // 4
$vm->memory; // 8192 (MB)
$vm->disk; // 51200 (MB)
$vm->bandwidth; // 1073741824 (MB)
$vm->ns1; // 1.1.1.1 or null
$vm->ns2; // 8.8.8.8 or null
$vm->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

if ($vm->ipv4) {
    foreach ($vm->ipv4 as $ip4) {
        $ip4->id; // 52347
        $ip4->address; // 213.331.273.15
        $ip4->ptr; // something.domain.tld
        $ip4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
    }
}
if ($vm->ipv6) {
    foreach ($vm->ipv6 as $ip6) {
         $ip6->id; // 52347
         $ip6->address; // 2a00:4000:f:eaee::1
         $ip6->ptr; // something.domain.tld
         $ip6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
     }
}
if ($vm->template) {
    $vm->template->id; // 6523
    $vm->template->name; // Ubuntu 20.04 LTS
    $vm->template->description; // Ubuntu 20.04 LTS
    $vm->template->documentation; // https://docs.ubuntu.com
    $vm->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
}

$vm->toArray(); // ['id' => 17923, 'firewall_group_id' => null, 'hostname' => '...', 'state' => 'running', ...]
```

#### Get Virtual Machine List

Retrieves a list of all virtual machines in your account.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines)

```php
$vms = $hostinger->vps()->virtualMachines()->list();

foreach ($vms as $vm) {
    $vm->id; // 17923
    $vm->firewall_group_id; // null
    $vm->subscription_id; // Azz353Uhl1xC54pR0
    $vm->plan; // KVM 4
    $vm->hostname; // srv17923.hstgr.cloud
    $vm->state->value; // running
    $vm->actions_lock->value; // unlocked
    $vm->cpus; // 4
    $vm->memory; // 8192
    $vm->disk; // 51200
    $vm->bandwidth; // 1073741824
    $vm->ns1; // 1.1.1.1
    $vm->ns2; // 8.8.8.8
    $vm->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

    if ($vm->ipv4) {
        foreach ($vm->ipv4 as $ip4) {
            $ip4->id; // 52347
            $ip4->address; // 213.331.273.15
            $ip4->ptr; // something.domain.tld
            $ip4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
        }
    }
    if ($vm->ipv6) {
         foreach ($vm->ipv6 as $ip6) {
             $ip6->id; // 52347
             $ip6->address; // 2a00:4000:f:eaee::1
             $ip6->ptr; // something.domain.tld
             $ip6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
         }
    }
    if ($vm->template) {
        $vm->template->id; // 6523
        $vm->template->name; // Ubuntu 20.04 LTS
        $vm->template->description; // Ubuntu 20.04 LTS
        $vm->template->documentation; // https://docs.ubuntu.com
        $vm->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
    }

    $vm->toArray(); // ['id' => 17923, 'firewall_group_id' => null, 'hostname' => '...', 'state' => 'running', ...]
}
```

#### Purchase New Virtual Machine

Allows you to buy (purchase) and setup a new virtual machine.

If virtual machine setup fails for any reason, login to hPanel and complete the setup manually.

If no payment method is provided, your default payment method will be used automatically.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines)

```php
$data = [
    'item_id' => 'hostingercom-vps-kvm2-usd-1m',
    'payment_method_id' => 1327362,
    'setup' => [
        'template_id' => 1130,
        'data_center_id' => 19,
        'post_install_script_id' => 6324,
        'password' => 'MyS3cureP@ssw0rd!',
        'hostname' => 'my.server.tld',
        'install_monarx' => false,
        'enable_backups' => true,
        'ns1' => '1.1.1.1',
        'ns2' => '1.0.0.1',
        'public_key' => [
            'name' => 'my-key',
            'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQC2X...'
        ]
    ],
    'coupons' => ['VPSPROMO'],
];

$order = $hostinger->vps()->virtualMachines()->purchase($data);

$order->id; // 2957087
$order->subscription_id; // Azz353Uhl1xC54pR0
$order->status->value; // completed
$order->currency; // USD
$order->subtotal; // 899
$order->total; // 1080

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
$order->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:22
```

#### Get Metrics

Retrieves historical performance metrics (CPU, RAM, Disk, Network, Uptime) for a VM within a specified time range.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/GET/api/vps/v1/virtual-machines/{virtualMachineId}/metrics)

```php
$virtualMachineId = 1268054;
$dateFrom = '2025-05-01T00:00:00Z'; // RFC 3339 format
$dateTo = '2025-06-01T00:00:00Z'; // RFC 3339 format
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

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/nameservers)

```php
$virtualMachineId = 1268054;
$data = [
    'ns1' => '1.1.1.1', // Primary nameserver IP
    'ns2' => '1.0.0.1', // Optional secondary nameserver IP
];
$action = $hostinger->vps()->virtualMachines()->setNameServers($virtualMachineId, $data);

$action->id; // 8123725
$action->name; // set_nameservers
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123725, 'name' => 'set_nameservers', 'state' => 'success', ...]
```

#### Set Panel Password

Sets the password for the control panel (if applicable to the OS template). Requires a strong password.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/panel-password)

```php
$virtualMachineId = 1268054;
$newPassword = 'VeryStr0ngP@ssw0rd!';
$action = $hostinger->vps()->virtualMachines()->setPanelPassword($virtualMachineId, $newPassword);

$action->id; // 8123726
$action->name; // set_panel_password
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123726, 'name' => 'set_panel_password', 'state' => 'success', ...]
```

#### Recreate Virtual Machine

Reinstalls the OS on a virtual machine. **Warning: All data will be lost! Snapshots will be deleted.** Requires a strong password if provided.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/recreate)

```php
$virtualMachineId = 1268054;
$data = [
    'template_id' => 1130, // ID of the OS template to install
    'password' => 'AnotherStr0ngP@ss!', // Optional: If omitted, a random one is generated
    'post_install_script_id' => 6324, // Optional: ID of a script to run after install
];

$action = $hostinger->vps()->virtualMachines()->recreate($virtualMachineId, $data);

$action->id; // 8123727
$action->name; // recreate
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-04-01 10:00:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-04-01 10:05:00

$action->toArray(); // ['id' => 8123727, 'name' => 'recreate', 'state' => 'success', ...]
```

#### Restart Virtual Machine

Restarts a virtual machine (equivalent to stop then start). Starts a stopped VM.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/restart)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->virtualMachines()->restart($virtualMachineId);

$action->id; // 8123712
$action->name; // restart
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123712, 'name' => 'restart', 'state' => 'success', ...]
```

#### Set Root Password

Sets the root password for the virtual machine. Requires a strong password.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/PUT/api/vps/v1/virtual-machines/{virtualMachineId}/root-password)

```php
$virtualMachineId = 1268054;
$newPassword = 'EvenM0reSecur3P@ss!';
$action = $hostinger->vps()->virtualMachines()->setRootPassword($virtualMachineId, $newPassword);

$action->id; // 8123728
$action->name; // set_root_password
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123728, 'name' => 'set_root_password', 'state' => 'success', ...]
```

#### Setup New Virtual Machine

Sets up a newly purchased VPS (in `initial` state). Requires OS template and data center.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/setup)

```php
$virtualMachineId = 1268054;
$data = [
    'template_id' => 1130,
    'data_center_id' => 19,
    'password' => 'MyS3cureP@ssw0rd!', // Optional: Strong password, random if omitted
    'hostname' => 'my.server.tld', // Optional: Override default hostname
    'install_monarx' => false, // Optional: Install malware scanner (default: false)
    'enable_backups' => true, // Optional: Enable weekly backups (default: true)
    'ns1' => '1.1.1.1', // Optional: Primary DNS resolver
    'ns2' => '1.0.0.1', // Optional: Secondary DNS resolver
    'post_install_script_id' => 6324, // Optional: Script to run after setup
    'public_key' => [ // Optional: Add and attach a new SSH key
        'name' => 'my-setup-key',
        'key' => 'ssh-rsa AAAAB3NzaC1yc2EAAA...',
    ]
];

$vm = $hostinger->vps()->virtualMachines()->setup($virtualMachineId, $data);

$vm->id; // 1268054
$vm->firewall_group_id; // null
$vm->subscription_id; // Azz353Uhl1xC54pR0
$vm->plan; // KVM 4
$vm->hostname; // my.server.tld
$vm->state->value; // creating
$vm->actions_lock->value; // unlocked
$vm->cpus; // 4
$vm->memory; // 8192
$vm->disk; // 51200
$vm->bandwidth; // 1073741824
$vm->ns1; // 1.1.1.1
$vm->ns2; // 1.0.0.1
$vm->created_at->format('Y-m-d H:i:s'); // 2024-09-05 07:25:36

if ($vm->ipv4) {
    foreach ($vm->ipv4 as $ipv4) {
        $ipv4->id; // 52347
        $ipv4->address; // 213.331.273.15
        $ipv4->ptr; // something.domain.tld
        $ipv4->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
    }
}
if ($vm->ipv6) {
     foreach ($vm->ipv6 as $ipv6) {
         $ipv6->id; // 52347
         $ipv6->address; // 2a00:4000:f:eaee::1
         $ipv6->ptr; // something.domain.tld
         $ipv6->toArray(); // ['id' => 52347, 'address' => '...', 'ptr' => '...']
     }
}
if ($vm->template) {
    $vm->template->id; // 6523
    $vm->template->name; // Ubuntu 20.04 LTS
    $vm->template->description; // Ubuntu 20.04 LTS
    $vm->template->documentation; // https://docs.ubuntu.com
    $vm->template->toArray(); // ['id' => 6523, 'name' => '...', ...]
}

$vm->toArray(); // ['id' => 1268054, 'firewall_group_id' => null, 'hostname' => 'my.server.tld', 'state' => 'creating', ...]
```

#### Start Virtual Machine

Starts a stopped virtual machine.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/start)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->virtualMachines()->start($virtualMachineId);

$action->id; // 8123729
$action->name; // start
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123729, 'name' => 'start', 'state' => 'success', ...]
```

#### Stop Virtual Machine

Stops a running virtual machine.

*Doc:* [API Reference](https://developers.hostinger.com/#tag/vps-virtual-machine/POST/api/vps/v1/virtual-machines/{virtualMachineId}/stop)

```php
$virtualMachineId = 1268054;
$action = $hostinger->vps()->virtualMachines()->stop($virtualMachineId);

$action->id; // 8123730
$action->name; // stop
$action->state->value; // success
$action->created_at->format('Y-m-d H:i:s'); // 2025-02-27 11:54:00
$action->updated_at->format('Y-m-d H:i:s'); // 2025-02-27 11:58:00

$action->toArray(); // ['id' => 8123730, 'name' => 'stop', 'state' => 'success', ...]
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
