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
    Schema::create('dps_maturities', function (Blueprint $table) {

        $table->id();


        $table->foreignId('dps_account_id')
              ->constrained()
              ->cascadeOnDelete();


        $table->decimal('total_deposit',10,2);


        $table->decimal('profit_amount',10,2);


        $table->decimal('maturity_amount',10,2);


        $table->date('paid_date')
              ->nullable();


        $table->enum('status',
        [
            'pending',
            'paid'
        ])
        ->default('pending');


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dps_maturities');
    }
};
