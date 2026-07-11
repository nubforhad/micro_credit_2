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
        Schema::create('fund_transactions', function (Blueprint $table) {

            $table->id();

            // Which fund account
            $table->foreignId('fund_account_id')
                ->constrained('fund_accounts')
                ->cascadeOnDelete();


            // Transaction date
            $table->date('transaction_date');


            // Transaction type
            $table->enum('type', [

                'opening_balance',
                'loan_disbursement',
                'loan_collection',
                'saving_deposit',
                'saving_withdraw',
                'dps_deposit',
                'dps_maturity',
                'income',
                'expense',
                'transfer'

            ]);


            // Debit / Credit
            $table->enum('dr_cr', [

                'debit',
                'credit'

            ]);


            // Amount
            $table->decimal('amount', 15, 2);


            // Balance after transaction
            $table->decimal('balance_after', 15, 2);


            // Relation with other module
            $table->string('reference_type')->nullable();

            $table->unsignedBigInteger('reference_id')->nullable();


            // Note
            $table->text('remarks')->nullable();


            // User
            $table->foreignId('created_by')
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
        Schema::dropIfExists('fund_transactions');
    }
};