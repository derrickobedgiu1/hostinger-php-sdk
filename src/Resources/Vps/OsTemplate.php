<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\OsTemplate as OsTemplateData;
use DerrickOb\HostingerApi\Exceptions\ApiException;
use DerrickOb\HostingerApi\Exceptions\AuthenticationException;
use DerrickOb\HostingerApi\Exceptions\RateLimitException;
use DerrickOb\HostingerApi\Resources\Resource;

/**
 * Resource for interacting with the VPS OS Templates API.
 *
 * @link https://developers.hostinger.com/#tag/vps-os-templates
 */
final class OsTemplate extends Resource
{
    /**
     * Get OS template list.
     *
     * @return array<OsTemplateData> List of available OS templates
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates
     */
    public function list(): array
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/templates', $version));

        /** @var array<OsTemplateData> */
        return $this->transformResponse(OsTemplateData::class, $response);
    }

    /**
     * Get OS template details.
     *
     * @param int $templateId Template ID
     *
     * @return OsTemplateData The OS template details
     *
     * @throws AuthenticationException When authentication fails (401)
     * @throws RateLimitException      When rate limit is exceeded (429)
     * @throws ApiException            For other API errors
     *
     * @link https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates/{templateId}
     *
     */
    public function get(int $templateId): OsTemplateData
    {
        $version = $this->getApiVersion();
        $response = $this->client->get(sprintf('/api/vps/%s/templates/%d', $version, $templateId));

        /** @var OsTemplateData */
        return $this->transformResponse(OsTemplateData::class, $response);
    }
}
