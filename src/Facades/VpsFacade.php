<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Facades;

use DerrickOb\HostingerApi\ClientInterface;
use DerrickOb\HostingerApi\Resources\Vps\Action;
use DerrickOb\HostingerApi\Resources\Vps\Backup;
use DerrickOb\HostingerApi\Resources\Vps\DataCenter;
use DerrickOb\HostingerApi\Resources\Vps\Firewall;
use DerrickOb\HostingerApi\Resources\Vps\MalwareScanner;
use DerrickOb\HostingerApi\Resources\Vps\OsTemplate;
use DerrickOb\HostingerApi\Resources\Vps\PtrRecord;
use DerrickOb\HostingerApi\Resources\Vps\PublicKey;
use DerrickOb\HostingerApi\Resources\Vps\Recovery;
use DerrickOb\HostingerApi\Resources\Vps\Snapshot;
use DerrickOb\HostingerApi\Resources\Vps\VirtualMachine;

/**
 * Facade for accessing VPS-related API resources.
 */
final class VpsFacade
{
    /**
     * @param ClientInterface $client The API client
     */
    public function __construct(private readonly ClientInterface $client)
    {
    }

    /**
     * Access the Action resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-actions
     *
     * @return Action The action resource instance
     */
    public function actions(): Action
    {
        return new Action($this->client);
    }

    /**
     * Access the Backup resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-backups
     *
     * @return Backup The backup resource instance
     */
    public function backups(): Backup
    {
        return new Backup($this->client);
    }

    /**
     * Access the DataCenter resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-data-centers
     *
     * @return DataCenter The data center resource instance
     */
    public function dataCenters(): DataCenter
    {
        return new DataCenter($this->client);
    }

    /**
     * Access the Firewall resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-firewall
     *
     * @return Firewall The firewall resource instance
     */
    public function firewalls(): Firewall
    {
        return new Firewall($this->client);
    }

    /**
     * Access the MalwareScanner resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-malware-scanner
     *
     * @return MalwareScanner The malware scanner resource instance
     */
    public function malwareScanner(): MalwareScanner
    {
        return new MalwareScanner($this->client);
    }

    /**
     * Access the OsTemplate resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-os-templates
     *
     * @return OsTemplate The OS template resource instance
     */
    public function templates(): OsTemplate
    {
        return new OsTemplate($this->client);
    }

    /**
     * Access the PtrRecord resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-ptr-records
     *
     * @return PtrRecord The PTR record resource instance
     */
    public function ptrRecords(): PtrRecord
    {
        return new PtrRecord($this->client);
    }

    /**
     * Access the PublicKey resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-public-keys
     *
     * @return PublicKey The public key resource instance
     */
    public function publicKeys(): PublicKey
    {
        return new PublicKey($this->client);
    }

    /**
     * Access the Recovery resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-recovery
     *
     * @return Recovery The recovery resource instance
     */
    public function recovery(): Recovery
    {
        return new Recovery($this->client);
    }

    /**
     * Access the Snapshot resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-snapshots
     *
     * @return Snapshot The snapshot resource instance
     */
    public function snapshots(): Snapshot
    {
        return new Snapshot($this->client);
    }

    /**
     * Access the VirtualMachine resource.
     *
     * @link https://developers.hostinger.com/#tag/vps-virtual-machine
     *
     * @return VirtualMachine The virtual machine resource instance
     */
    public function virtualMachines(): VirtualMachine
    {
        return new VirtualMachine($this->client);
    }
}
