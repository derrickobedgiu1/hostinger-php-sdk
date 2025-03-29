<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Vps;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use DerrickOb\HostingerApi\Enums\ActionState;
use Exception;

/**
 * Represents an Action performed on a VPS instance.
 */
final class Action extends Data
{
    /** @var int Unique identifier for the action. */
    public int $id;

    /** @var string Name of the action (e.g., start, stop, restart). */
    public string $name;

    /** @var ActionState Current state of the action. */
    public ActionState $state;

    /** @var DateTimeImmutable Date and time when the action was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable Date and time when the action was last updated. */
    public DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      id: int,
     *      name: string,
     *      state: string,
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
        $this->state = ActionState::from($data['state']);
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = new DateTimeImmutable($data['updated_at']);
    }
}
