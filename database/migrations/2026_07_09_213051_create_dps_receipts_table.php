<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('dps_receipts', function (Blueprint $table) {

            $table->id();


            $table->foreignId('dps_payment_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->string('receipt_no')
                ->unique();


            $table->foreignId('collector_id')
                ->nullable()
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
        Schema::dropIfExists('dps_receipts');
    }
};
