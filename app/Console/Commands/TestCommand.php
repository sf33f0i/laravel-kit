<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class TestCommand extends Command
{
    protected $signature = 'test';
    protected $description = 'Test command';

    public function handle(): int
    {
        return SymfonyCommand::SUCCESS;
    }
}
