<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data;

/**
 * Represents a generic success response from the API.
 */
final class SuccessResponse extends Data
{
    /** @var string Success message. */
    public string $message;

    /**
     * @param array{
     *     message: string
     * } $data
     */
    public function __construct(array $data)
    {
        $this->message = $data['message'];
    }
}
