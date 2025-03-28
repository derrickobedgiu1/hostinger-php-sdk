<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Exceptions;

/**
 * Exception thrown when validation fails (422 status code).
 */
final class ValidationException extends ApiException
{
    /**
     * @param string                            $message       Error message
     * @param int                               $code          Error code
     * @param string|null                       $correlationId Correlation ID for tracking
     * @param array<string, array<int, string>> $errors        Validation error details
     */
    public function __construct(string $message, int $code = 0, ?string $correlationId = null, protected array $errors = [])
    {
        parent::__construct($message, $code, $correlationId);
    }

    /**
     * Get validation errors.
     *
     * @return array<string, array<int, string>> Validation error details
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
