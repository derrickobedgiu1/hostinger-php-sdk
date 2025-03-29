<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents an SSH public key for secure VPS access.
 */
final class PublicKey extends Data
{
    /** @var int Unique identifier for the public key. */
    public int $id;

    /** @var string Display name for the public key. */
    public string $name;

    /** @var string The actual public key content. */
    public string $key;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      key: string
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->key = $data['key'];
    }
}
