<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Tests\Unit\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\OsTemplate as OsTemplateData;
use DerrickOb\HostingerApi\Resources\Vps\OsTemplate;
use DerrickOb\HostingerApi\Tests\TestFactory;

test('can list OS templates', function (): void {
    $templates = [];
    for ($i = 0; $i < 4; $i++) {
        $templates[] = TestFactory::osTemplate();
    }

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/templates')
        ->once()
        ->andReturn($templates);

    $resource = new OsTemplate($client);

    /** @var array<OsTemplateData> $response */
    $response = $resource->list();

    expect($response)->toBeArray()
        ->and($response)->toHaveCount(4)
        ->and($response[0])->toBeInstanceOf(OsTemplateData::class)
        ->and($response[0]->id)->toBe($templates[0]['id'])
        ->and($response[0]->name)->toBe($templates[0]['name'])
        ->and($response[0]->description)->toBe($templates[0]['description']);
});

test('can get OS template details', function (): void {
    $faker = faker();
    $templateId = $faker->randomNumber(7);

    $template = TestFactory::osTemplate(['id' => $templateId]);

    $client = createMockClient();
    $client->shouldReceive('get')
        ->with('/api/vps/v1/templates/' . $templateId)
        ->once()
        ->andReturn($template);

    $resource = new OsTemplate($client);
    $response = $resource->get($templateId);

    expect($response)->toBeInstanceOf(OsTemplateData::class)
        ->and($response->id)->toBe($templateId)
        ->and($response->name)->toBe($template['name'])
        ->and($response->description)->toBe($template['description']);
});
