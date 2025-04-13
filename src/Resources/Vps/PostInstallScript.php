<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\PaginatedResponse;
use DerrickOb\HostingerApi\Data\SuccessResponse;
use DerrickOb\HostingerApi\Data\Vps\PostInstallScript as PostInstallScriptData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Exceptions\ValidationException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS Post-Install Scripts API.
 *
 * @link https://developers.hostinger.com/#tag/vps-post-install-scripts
 */
final class PostInstallScript extends Resource
{
    /**
     * Get post-install script list.
     *
     * @param array<string, mixed> $query Optional query parameters (like page)
     *
     * @return PaginatedResponse The post-install scripts list
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-post-install-scripts/GET/api/vps/v1/post-install-scripts
     *
     */
    public function list(array $query = []): PaginatedResponse
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/post-install-scripts', $version), $query);

        /** @var PaginatedResponse */
        return $this->transform(PostInstallScriptData::class, $response);
    }

    /**
     * Get post-install script details.
     *
     * @param int $postInstallScriptId Post-install script ID
     *
     * @return PostInstallScriptData The post-install script details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-post-install-scripts/GET/api/vps/v1/post-install-scripts/{postInstallScriptId}
     *
     */
    public function get(int $postInstallScriptId): PostInstallScriptData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/post-install-scripts/%d', $version, $postInstallScriptId));

        /** @var PostInstallScriptData */
        return $this->transform(PostInstallScriptData::class, $response);
    }

    /**
     * Create new post-install script.
     *
     * @param array{
     *     name: string,
     *     content: string
     * } $data Post-install script creation data
     *
     * @return PostInstallScriptData The created post-install script
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-post-install-scripts/POST/api/vps/v1/post-install-scripts
     *
     */
    public function create(array $data): PostInstallScriptData
    {
        $version = $this->getApiVersion();
        $response = $this->client->post(sprintf('/api/vps/%s/post-install-scripts', $version), $data);

        /** @var PostInstallScriptData */
        return $this->transform(PostInstallScriptData::class, $response);
    }

    /**
     * Update post-install script.
     *
     * @param int $postInstallScriptId Post-install script ID
     * @param array{
     *     name: string,
     *     content: string
     * } $data Post-install script update data
     *
     * @return PostInstallScriptData The updated post-install script
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws ValidationException     When validation fails (422)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-post-install-scripts/PUT/api/vps/v1/post-install-scripts/{postInstallScriptId}
     *
     */
    public function update(int $postInstallScriptId, array $data): PostInstallScriptData
    {
        $version = $this->getApiVersion();
        $response = $this->client->put(sprintf('/api/vps/%s/post-install-scripts/%d', $version, $postInstallScriptId), $data);

        /** @var PostInstallScriptData */
        return $this->transform(PostInstallScriptData::class, $response);
    }

    /**
     * Delete post-install script.
     *
     * @param int $postInstallScriptId Post-install script ID
     *
     * @return SuccessResponse Success response
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-post-install-scripts/DELETE/api/vps/v1/post-install-scripts/{postInstallScriptId}
     *
     */
    public function delete(int $postInstallScriptId): SuccessResponse
    {
        $version = $this->getApiVersion();

        $response = $this->client->delete(sprintf('/api/vps/%s/post-install-scripts/%d', $version, $postInstallScriptId));

        /** @var SuccessResponse */
        return $this->transform(SuccessResponse::class, $response);
    }
}
