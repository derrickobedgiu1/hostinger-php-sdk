<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Exceptions;

use DerrickOb\HostingerApi\Exceptions\ValidationException;

test('can get validation errors', function (): void {
    $errors = [
        'field_1' => [
            'field_1 must be string',
            'field_1 is required',
        ],
    ];

    $exception = new ValidationException('test message', 422, 'test-correlation-id', $errors);
    expect($exception->getErrors())->toBe($errors);
});
