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
        Schema::create('loans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('loan_product_id')
                ->constrained('loan_products')
                ->cascadeOnDelete();

            $table->string('loan_no')->unique();

            $table->decimal('amount', 12, 2);

            $table->decimal('total_payable', 12, 2)->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'running',
                'closed'
            ])->default('pending');

            $table->date('start_date')->nullable();

            $table->text('note')->nullable();

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
        Schema::dropIfExists('loans');
    }
};