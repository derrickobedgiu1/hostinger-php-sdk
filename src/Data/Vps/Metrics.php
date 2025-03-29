<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents performance metrics for a VPS instance.
 */
final class Metrics extends Data
{
    /** @var MetricsData|null CPU usage metrics (percentage). */
    public ?MetricsData $cpu_usage;

    /** @var MetricsData|null RAM usage metrics (bytes). */
    public ?MetricsData $ram_usage;

    /** @var MetricsData|null Disk space usage metrics (bytes). */
    public ?MetricsData $disk_space;

    /** @var MetricsData|null Outgoing network traffic metrics (bytes). */
    public ?MetricsData $outgoing_traffic;

    /** @var MetricsData|null Incoming network traffic metrics (bytes). */
    public ?MetricsData $incoming_traffic;

    /** @var MetricsData|null Uptime metrics (milliseconds). */
    public ?MetricsData $uptime;

    /**
     * @param array{
     *      cpu_usage?: array{
     *          unit: string,
     *          usage: array<string, float>
     *      },
     *      ram_usage?: array{
     *          unit: string,
     *          usage: array<string, int>
     *      },
     *      disk_space?: array{
     *          unit: string,
     *          usage: array<string, int>
     *      },
     *      outgoing_traffic?: array{
     *          unit: string,
     *          usage: array<string, int>
     *      },
     *      incoming_traffic?: array{
     *          unit: string,
     *          usage: array<string, int>
     *      },
     *      uptime?: array{
     *          unit: string,
     *          usage: array<string, int>
     *      }
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->cpu_usage = isset($data['cpu_usage']) ? new MetricsData($data['cpu_usage']) : null;
        $this->ram_usage = isset($data['ram_usage']) ? new MetricsData($data['ram_usage']) : null;
        $this->disk_space = isset($data['disk_space']) ? new MetricsData($data['disk_space']) : null;
        $this->outgoing_traffic = isset($data['outgoing_traffic']) ? new MetricsData($data['outgoing_traffic']) : null;
        $this->incoming_traffic = isset($data['incoming_traffic']) ? new MetricsData($data['incoming_traffic']) : null;
        $this->uptime = isset($data['uptime']) ? new MetricsData($data['uptime']) : null;
    }
}
