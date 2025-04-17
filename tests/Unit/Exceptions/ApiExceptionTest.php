<?php

use DerrickOb\HostingerApi\Exceptions\ApiException;

test('can get the correlation ID', function (): void {
    $exception = new ApiException('Test message', 500, 'test-correlation-id');
    expect($exception->getCorrelationId())->toBe('test-correlation-id');

    $exceptionWithoutCorrelationId = new ApiException('Test message', 500);
    expect($exceptionWithoutCorrelationId->getCorrelationId())->toBeNull();
});
