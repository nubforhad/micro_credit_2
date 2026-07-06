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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('area_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('code')->nullable();
            $table->string('meeting_day')->nullable(); // weekly meeting day
            $table->time('meeting_time')->nullable();

            $table->text('address')->nullable();

            $table->boolean('status')->default(1);

            $table->foreignId('created_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
