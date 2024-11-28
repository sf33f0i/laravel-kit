<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const string TABLE_NAME = 'geodata';
    private const string COLUMN = 'position';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE EXTENSION postgis');
        Schema::table(self::TABLE_NAME, static function (Blueprint $table): void {
            $table->point(self::COLUMN)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, static function (Blueprint $table): void {
            $table->dropColumn(self::COLUMN);
        });
        DB::statement('DROP EXTENSION postgis');
    }
};
