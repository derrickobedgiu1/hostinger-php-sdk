<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents a post-install script for VPS instances.
 */
final class PostInstallScript extends Data
{
    /** @var int Unique identifier for the post-install script. */
    public int $id;

    /** @var string Display name of the post-install script. */
    public string $name;

    /** @var string The actual script content. */
    public string $content;

    /** @var DateTimeImmutable Date and time when the script was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the script was last updated. */
    public DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      content: string,
     *      created_at: string,
     *      updated_at: string
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->content = $data['content'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
    }
}
