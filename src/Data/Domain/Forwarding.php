<?php

declare(strict_types=1);

namespace DerrickOb\HostingerApi\Data\Domain;

use DateTimeImmutable;
use DerrickOb\HostingerApi\Data\Data;
use Exception;

/**
 * Represents Domain Forwarding data.
 */
final class Forwarding extends Data
{
    /** @var string Domain name being forwarded. */
    public string $domain;

    /** @var string Redirect type (301 or 302). */
    public string $redirect_type;

    /** @var string URL the domain is forwarded to. */
    public string $redirect_url;

    /** @var DateTimeImmutable Date and time when the forwarding was created. */
    public DateTimeImmutable $created_at;

    /** @var DateTimeImmutable|null Date and time when the forwarding was last updated. */
    public ?DateTimeImmutable $updated_at;

    /**
     * @param array{
     *      domain: string,
     *      redirect_type: string,
     *      redirect_url: string,
     *      created_at: string,
     *      updated_at?: string|null
     *  } $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->domain = $data['domain'];
        $this->redirect_type = $data['redirect_type'];
        $this->redirect_url = $data['redirect_url'];
        $this->created_at = new DateTimeImmutable($data['created_at']);
        $this->updated_at = isset($data['updated_at']) ? new DateTimeImmutable($data['updated_at']) : null;
    }
}
