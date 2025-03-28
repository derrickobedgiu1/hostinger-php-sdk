<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Exceptions;

use Exception;

/**
 * Base exception for API errors.
 */
class ApiException extends Exception
{
    /**
     * @param string      $message       Error message
     * @param int         $code          Error code
     * @param string|null $correlationId Correlation ID for tracking the request in API logs.
     */
    public function __construct(string $message, int $code = 0, protected ?string $correlationId = null)
    {
        parent::__construct($message, $code);
    }

    /**
     * Get the correlation ID.
     *
     * @return string|null The correlation ID or null if not available
     */
    public function getCorrelationId(): ?string
    {
        return $this->correlationId;
    }
}
