<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Exceptions;

final class ValidationException extends ApiException
{
    public function __construct(string $message, int $code = 0, ?string $correlationId = null, protected array $errors = [])
    {
        parent::__construct($message, $code, $correlationId);
    }

    /**
     * Get validation errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
