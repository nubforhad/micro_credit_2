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
    Schema::create('members', function (Blueprint $table) {
        $table->id();

        $table->foreignId('center_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('member_no')->unique();

        $table->string('name');
        $table->string('father_name')->nullable();
        $table->string('mother_name')->nullable();

        $table->date('birth_date')->nullable();
        $table->string('nid')->nullable();
        $table->string('phone')->nullable();

        $table->text('address')->nullable();

        $table->string('photo')->nullable();

        $table->string('nominee_name')->nullable();
        $table->string('nominee_relation')->nullable();
        $table->string('nominee_phone')->nullable();

        $table->boolean('status')->default(1);

        $table->foreignId('created_by')->nullable()
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
        Schema::dropIfExists('members');
    }
};
