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
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Main Cash, Bank Account, Branch Cash

            $table->decimal('opening_balance', 15, 2)->default(0);

            $table->decimal('current_balance', 15, 2)->default(0);

            $table->enum('type', [
                'cash',
                'bank',
                'mobile_banking',
                'other'
            ])->default('cash');

            $table->boolean('is_default')->default(false);

            $table->boolean('status')->default(true);

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_accounts');
    }
};