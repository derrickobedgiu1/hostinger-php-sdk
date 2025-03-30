<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Resources\Vps;

use DerrickOb\HostingerApi\Data\Vps\OsTemplate as OsTemplateData;
use DerrickOb\HostingerApi\Resources\AbstractResource;

/**
 * Resource for interacting with the VPS OS Templates API.
 *
 * @link https://developers.hostinger.com/#tag/vps-os-templates
 */
final class OsTemplate extends AbstractResource
{
    /**
     * Get OS template list.
     *
     * @link https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates
     *
     * @return array<OsTemplateData> List of available OS templates
     *
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
     * @link https://developers.hostinger.com/#tag/vps-os-templates/GET/api/vps/v1/templates/{templateId}
     *
     * @return OsTemplateData The OS template details
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
