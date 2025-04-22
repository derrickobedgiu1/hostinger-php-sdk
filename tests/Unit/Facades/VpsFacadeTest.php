<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Facades;

use DerrickOb\HostingerApi\Facades\VpsFacade;
use DerrickOb\HostingerApi\Resources\Vps\Action;
use DerrickOb\HostingerApi\Resources\Vps\Backup;
use DerrickOb\HostingerApi\Resources\Vps\DataCenter;
use DerrickOb\HostingerApi\Resources\Vps\Firewall;
use DerrickOb\HostingerApi\Resources\Vps\MalwareScanner;
use DerrickOb\HostingerApi\Resources\Vps\OsTemplate;
use DerrickOb\HostingerApi\Resources\Vps\PostInstallScript;
use DerrickOb\HostingerApi\Resources\Vps\PtrRecord;
use DerrickOb\HostingerApi\Resources\Vps\PublicKey;
use DerrickOb\HostingerApi\Resources\Vps\Recovery;
use DerrickOb\HostingerApi\Resources\Vps\Snapshot;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;

test('can access the action resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->actions())->toBeInstanceOf(Action::class);
});

test('can access the backup resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->backups())->toBeInstanceOf(Backup::class);
});

test('can access the data center resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->dataCenters())->toBeInstanceOf(DataCenter::class);
});

test('can access the firewall resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->firewalls())->toBeInstanceOf(Firewall::class);
});

test('can access the malware scanner resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->malwareScanner())->toBeInstanceOf(MalwareScanner::class);
});

test('can access the os template resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->templates())->toBeInstanceOf(OsTemplate::class);
});

test('can access the ptr record resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->ptrRecords())->toBeInstanceOf(PtrRecord::class);
});

test('can access the public key resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->publicKeys())->toBeInstanceOf(PublicKey::class);
});

test('can access the recovery resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->recovery())->toBeInstanceOf(Recovery::class);
});

test('can access the snapshot resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->snapshots())->toBeInstanceOf(Snapshot::class);
});

test('can access the virtual machine resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->virtualMachines())->toBeInstanceOf(VirtualMachine::class);
});

test('can access the post install script resource', function (): void {
    $client = createMockClient();
    $facade = new VpsFacade($client);
    expect($facade->postInstallScripts())->toBeInstanceOf(PostInstallScript::class);
});
