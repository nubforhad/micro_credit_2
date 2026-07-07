<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('loan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('loan_installment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('receipt_no')->unique();

            $table->date('payment_date');

            $table->decimal('amount',12,2);

            $table->enum('payment_method',[
                'Cash',
                'Bank',
                'bKash',
                'Nagad',
                'Rocket'
            ])->default('Cash');

            $table->text('note')->nullable();

            $table->foreignId('received_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_payments');
    }
};