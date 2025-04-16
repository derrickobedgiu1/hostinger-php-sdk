<?php

use DerrickOb\HostingerApi\Facades\DomainFacade;
use DerrickOb\HostingerApi\Resources\Domain\Portfolio;

test('can access the portfolio resource', function (): void {
    $client = createMockClient();
    $facade = new DomainFacade($client);
    expect($facade->portfolio())->toBeInstanceOf(Portfolio::class);
});
