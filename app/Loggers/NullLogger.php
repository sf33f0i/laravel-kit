<?php

declare(strict_types=1);

namespace App\Loggers;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Stringable;

class NullLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, Stringable|string $message, array $context = []): void {}
}
