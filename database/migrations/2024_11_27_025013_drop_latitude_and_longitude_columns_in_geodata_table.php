<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const string TABLE = 'geodata';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table): void {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table): void {
            $table->decimal('latitude', total: 8, places: 6)->nullable();
            $table->decimal('longitude', total: 9, places: 6)->nullable();
        });
    }
};
