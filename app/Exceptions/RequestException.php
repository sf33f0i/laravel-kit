<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Interfaces\RequestExceptionInterface;
use App\Traits\RequestForException;
use Psr\Http\Message\RequestInterface;
use Throwable;

/**
 * Class RequestException.
 */
class RequestException extends ClientException implements RequestExceptionInterface
{
    use RequestForException;

    /**
     * NetworkException constructor.
     *
     * @param RequestInterface $request
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(RequestInterface $request, string $message = '', Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->request = $request;
    }
}
