<?php

declare(strict_types=1);

namespace App\Interfaces;

use Psr\Http\Message\RequestInterface;

interface RequestExceptionInterface extends ClientExceptionInterface
{
    public function getRequest(): RequestInterface;
}
