<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mask');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_type_id')->constrained();
            $table->string('serial_number')->unique();
            $table->string('comment');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_type');
        Schema::dropIfExists('equipment');
    }
};
