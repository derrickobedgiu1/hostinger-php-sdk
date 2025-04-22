<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Data;

use DerrickOb\HostingerApi\Data\Data;

final class TestDataDto extends Data
{
    public int $id;

    public string $name;

    /**
     * @param array{
     *     id: int,
     *     name: string,
     * } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }
}
