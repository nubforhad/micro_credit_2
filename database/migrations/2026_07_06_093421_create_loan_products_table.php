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
    Schema::create('loan_products', function (Blueprint $table) {

        $table->id();

        $table->string('name');
        $table->string('code')->unique();

        $table->decimal('interest_rate',5,2);

        $table->enum('interest_type',[
            'flat',
            'declining'
        ])->default('flat');

        $table->enum('installment_type',[
            'daily',
            'weekly',
            'monthly'
        ])->default('weekly');

        $table->unsignedInteger('duration');

        $table->decimal('processing_fee',10,2)->default(0);

        $table->decimal('insurance_fee',10,2)->default(0);

        $table->decimal('late_fee',10,2)->default(0);

        $table->decimal('min_amount',12,2);

        $table->decimal('max_amount',12,2);

        $table->boolean('status')->default(true);

        $table->text('description')->nullable();

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
        Schema::dropIfExists('loan_products');
    }
};
