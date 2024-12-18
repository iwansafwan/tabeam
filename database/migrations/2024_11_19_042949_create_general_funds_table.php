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
        Schema::create('general_funds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('collected_amount', 10, 2);
            $table->text('qr_code')->nullable();
            $table->timestamps();
            //to maintain the historical record in database
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_funds');
    }
};
