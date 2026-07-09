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
    Schema::create('dps_accounts', function (Blueprint $table) {

        $table->id();


        $table->foreignId('member_id')
              ->constrained()
              ->cascadeOnDelete();


        $table->foreignId('dps_plan_id')
              ->constrained()
              ->cascadeOnDelete();


        $table->string('account_no')->unique();


        $table->date('start_date');

        $table->date('maturity_date');


        $table->decimal('installment_amount',10,2);


        $table->integer('total_installment');


        $table->integer('paid_installment')
              ->default(0);


        $table->enum('status',
        [
            'running',
            'completed',
            'closed'
        ])
        ->default('running');


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dps_accounts');
    }
};
