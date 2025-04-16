<?php

use DerrickOb\HostingerApi\Client;
use DerrickOb\HostingerApi\Config;

test('can perform a GET request', function (): void {
    $httpClient = createMockHttpClient();
    $config = new Config('test-token');
    $client = new Client($config, $httpClient);
    $response = ['data' => 'test-data'];

    $httpClient->shouldReceive('request')
        ->once()
        ->with('GET', 'test-path', [])
        ->andReturn($response);

    $result = $client->get('test-path');

    expect($result)->toBe($response);
});

test('can perform a GET request with query parameters', function (): void {
    $httpClient = createMockHttpClient();
    $config = new Config('test-token');
    $client = new Client($config, $httpClient);
    $response = ['data' => 'test-data'];

    $httpClient->shouldReceive('request')
        ->once()
        ->with('GET', 'test-path', ['query' => ['key' => 'value']])
        ->andReturn($response);

    $result = $client->get('test-path', ['key' => 'value']);

    expect($result)->toBe($response);
});

test('can perform a POST request', function (): void {
    $httpClient = createMockHttpClient();
    $config = new Config('test-token');
    $client = new Client($config, $httpClient);
    $response = ['data' => 'test-data'];

    $httpClient->shouldReceive('request')
        ->once()
        ->with('POST', 'test-path', ['json' => ['key' => 'value']])
        ->andReturn($response);

    $result = $client->post('test-path', ['key' => 'value']);

    expect($result)->toBe($response);
});

test('can perform a PUT request', function (): void {
    $httpClient = createMockHttpClient();
    $config = new Config('test-token');
    $client = new Client($config, $httpClient);
    $response = ['data' => 'test-data'];

    $httpClient->shouldReceive('request')
        ->once()
        ->with('PUT', 'test-path', ['json' => ['key' => 'value']])
        ->andReturn($response);

    $result = $client->put('test-path', ['key' => 'value']);

    expect($result)->toBe($response);
});

test('can perform a DELETE request', function (): void {
    $httpClient = createMockHttpClient();
    $config = new Config('test-token');
    $client = new Client($config, $httpClient);
    $response = ['message' => 'Response accepted'];

    $httpClient->shouldReceive('request')
        ->once()
        ->with('DELETE', 'test-path', ['json' => ['key' => 'value']])
        ->andReturn($response);

    $result = $client->delete('test-path', ['key' => 'value']);

    expect($result)->toBe($response);
});

test('can get the API version from config', function (): void {
    $config = new Config('test-token', ['api_version' => 'v1']);
    $client = new Client($config);

    expect($client->getApiVersion())->toBe('v1');
});
