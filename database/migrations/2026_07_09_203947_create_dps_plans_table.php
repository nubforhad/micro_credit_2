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
        Schema::create('dps_plans', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->integer('duration_month');

            $table->decimal('installment_amount',10,2);

            $table->decimal('interest_rate',5,2)->default(0);

            $table->enum('status',['active','inactive'])
                ->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dps_plans');
    }
};
