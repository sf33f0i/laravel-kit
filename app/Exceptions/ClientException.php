<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use App\Interfaces\ClientExceptionInterface;

class ClientException extends Exception implements ClientExceptionInterface
{
}
