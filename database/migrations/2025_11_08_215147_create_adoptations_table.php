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
        Schema::create('adoptations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adoptationRequest_id')->constrained('adoptation_requests')->onDelete('cascade');
            $table->date('adoptation_date');
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptations');
    }
};
