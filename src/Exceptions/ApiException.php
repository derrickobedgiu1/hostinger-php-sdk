<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(string $message, int $code = 0, protected ?string $correlationId = null)
    {
        parent::__construct($message, $code);
    }

    /**
     * Get the correlation ID
     */
    public function getCorrelationId(): ?string
    {
        return $this->correlationId;
    }
}
