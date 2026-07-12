<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('income_expenses', function (Blueprint $table) {

            $table->id();


            // Income / Expense
            $table->enum('type',[
                'income',
                'expense'
            ]);


            // Category
            $table->string('category');


            // Amount
            $table->decimal(
                'amount',
                12,
                2
            );


            // Date
            $table->date('date');


            // Payment Method
            $table->enum('payment_method',[

                'Cash',
                'Bank',
                'bKash',
                'Nagad',
                'Rocket'

            ])
            ->default('Cash');


            // Note
            $table->text('note')
                ->nullable();


            // User
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('income_expenses');
    }

};