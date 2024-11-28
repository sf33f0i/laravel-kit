<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const string NEW_TABLE_NAME = 'geodata';
    private const string OLD_TABLE_NAME = 'addresses';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename(self::NEW_TABLE_NAME, self::OLD_TABLE_NAME);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename(self::OLD_TABLE_NAME, self::NEW_TABLE_NAME);
    }
};
