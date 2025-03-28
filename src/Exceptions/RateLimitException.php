<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Exceptions;

/**
 * Exception thrown when rate limit is exceeded (429 status code).
 */
final class RateLimitException extends ApiException
{
}
