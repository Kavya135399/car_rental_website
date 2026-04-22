<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('price_per_day', 10, 2)->nullable()->after('brand');
            $table->unsignedInteger('seats')->nullable()->after('price_per_day');
            $table->string('fuel_type')->nullable()->after('seats');
            $table->string('transmission')->nullable()->after('fuel_type');
            $table->boolean('featured')->default(false)->after('transmission');
            $table->text('description')->nullable()->after('featured');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'price_per_day',
                'seats',
                'fuel_type',
                'transmission',
                'featured',
                'description',
            ]);
        });
    }
};

