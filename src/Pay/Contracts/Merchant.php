<?php

declare(strict_types=1);

namespace EasyWeChat\Pay\Contracts;

interface Merchant
{
    public function getMerchantId(): int;
    public function getPrivateKey(): string;
    public function getCertificate(): string;
    public function getCertificateSerialNumber(): string;
    public function getSecretKey(): string;
}
