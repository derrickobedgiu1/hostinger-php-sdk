<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a specific metrics data set with timestamps.
 */
final class MetricsData extends Data
{
    /** @var string Measurement unit for this metrics dataset. */
    public string $unit;

    /** @var array<string, mixed> Timestamp-indexed usage values. */
    public array $usage;

    /**
     * @param array{
     *      unit: string,
     *      usage: array<string, mixed>
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->unit = $data['unit'];
        $this->usage = $data['usage'];
    }
}
