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
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            // Treasurer ID
            $table->unsignedBigInteger('treasurer_id');
            $table->foreign('treasurer_id')->references('id')->on('users');
            $table->string('name');
            $table->decimal('target_amount', 10, 2);
            $table->date('end_date');
            $table->text('description');
            $table->text('image')->nullable();
            $table->text('qr_code')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
