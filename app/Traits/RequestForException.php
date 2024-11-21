<?php

declare(strict_types=1);

namespace App\Traits;

use Psr\Http\Message\RequestInterface;

trait RequestForException
{
    protected RequestInterface $request;

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
