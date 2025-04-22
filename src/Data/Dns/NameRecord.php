<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Dns;

use DerrickOb\HostingerApi\Data\Data;

/**
 * Represents a DNS name record in the Hostinger DNS system.
 */
final class NameRecord extends Data
{
    /** @var string Content of the name record. */
    public string $content;

    /** @var bool Flag to mark name record as disabled. */
    public bool $is_disabled;

    /**
     * @param array{
     *      content: string,
     *      is_disabled?: bool
     *  } $data
     */
    public function __construct(array $data)
    {
        $this->content = $data['content'];
        $this->is_disabled = $data['is_disabled'] ?? false;
    }
}
