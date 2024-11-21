<?php

declare(strict_types=1);

namespace App\Interfaces;

use Psr\Http\Message\RequestInterface;

interface NetworkExceptionInterface extends ClientExceptionInterface
{
    public function getRequest(): RequestInterface;
}
