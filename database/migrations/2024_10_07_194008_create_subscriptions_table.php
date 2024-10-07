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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();// or uuid()
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('service_name');  // Name of the service being subscribed to
            $table->timestamp('start_date'); // Subscription start date
            $table->timestamp('end_date')->nullable(); // Subscription end date (null if ongoing)
            $table->string('status')->default('active'); // active, expired, canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
