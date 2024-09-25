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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointmentID');
            $table->dateTime('datetime'); // Added datetime for time
            $table->string('description');

            $table->unsignedBigInteger('therapistID');
            $table->foreign('therapistID')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('patientID');
            $table->foreign('patientID')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
