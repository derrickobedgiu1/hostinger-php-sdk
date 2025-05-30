<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Data\Vps\Action;
use DerrickOb\HostingerApi\Data\Vps\PublicKey as PublicKeyData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Public Keys API.
 *
 * @link https://developers.hostinger.com/#tag/vps-public-keys
 */
final class PublicKey extends Resource
{
    /**
     * Get public key list.
     *
     * @param array<string, mixed> $query Optional query parameters (like page)
     *
     * @return PaginatedResponse The public keys list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-public-keys/GET/api/vps/v1/public-keys
     *
     */
    public function list(array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/public-keys', $version), $query);

        /** @var PaginatedResponse */
        return $this->transform(PublicKeyData::class, $response);
    }

    /**
     * Create new public key.
     *
     * @param array{
     *     name: string,
     *     key: string
     * } $data Public key creation data
     *
     * @return PublicKeyData The created public key
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-public-keys/POST/api/vps/v1/public-keys
     *
     */
    public function create(array $data): PublicKeyData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/public-keys', $version), $data);

        /** @var PublicKeyData */
        return $this->transform(PublicKeyData::class, $response);
    }

    /**
     * Delete a public key.
     *
     * @param int $publicKeyId Public key ID
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-public-keys/DELETE/api/vps/v1/public-keys/{publicKeyId}
     *
     */
    public function delete(int $publicKeyId): SuccessResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->delete(sprintf('/api/vps/%s/public-keys/%d', $version, $publicKeyId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }

    /**
     * Attach public key to a virtual machine.
     *
     * @param int $virtualMachineId Virtual machine ID
     * @param array{
     *     ids: array<int>
     * } $ids Public key IDs to attach
     *
     * @return Action The initiated attachment action
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-public-keys/POST/api/vps/v1/public-keys/attach/{virtualMachineId}
     *
     */
    public function attach(int $virtualMachineId, array $ids): Action
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/public-keys/attach/%d', $version, $virtualMachineId), $ids);

        /** @var Action */
        return $this->transform(Action::class, $response);
    }
}
