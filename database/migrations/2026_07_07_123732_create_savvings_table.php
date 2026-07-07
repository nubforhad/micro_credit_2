<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::create('savvings', function (Blueprint $table) {


    $table->id();


    // Member
    $table->foreignId('member_id')
        ->constrained()
        ->cascadeOnDelete();



    // Receipt
    $table->string('receipt_no')
        ->unique();



    // Deposit / Withdraw
    $table->enum('type',[
        'deposit',
        'withdraw'
    ])
    ->default('deposit');



    // Amount
    $table->decimal(
        'amount',
        12,
        2
    );



    // Payment Method
    $table->enum('payment_method',[

        'Cash',
        'Bank',
        'bKash',
        'Nagad',
        'Rocket'

    ])
    ->default('Cash');



    // Transaction Date
    $table->date('date');



    // Note
    $table->text('note')
        ->nullable();



    // Created User
    $table->foreignId('created_by')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();



    $table->timestamps();


});

}



public function down(): void
{

Schema::dropIfExists('savvings');

}

};