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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 50);
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name', 50);
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_name', 50);
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('car_image', 150);
            $table->string('fuel_type', 50);
            $table->string('model_year', 50);
            $table->timestamps();
        });

        Schema::create('location_details', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 100);
            $table->timestamps();
        });

        Schema::create('rent_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreignId('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->double('rate_per_hr', 8, 2);
            $table->double('rate_per_day', 8, 2);
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->date('booking_from');
            $table->date('booking_to');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('amount', 8, 2);
            $table->string('booking_status', 100);
            $table->timestamps();
        });

        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('payment_type', ['cod', 'online_payment']);
            $table->enum('payment_status', ['pending', 'paid', 'payment_failed',]);
            $table->double('amount', 8, 2);
            $table->foreignId('location_id')->references('id')->on('location_details')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id_user_details');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('place', 100);
            $table->string('city', 100);
            $table->string('pincode', 100);
            $table->string('photo', 100);
            $table->string('aadhar_number', 100);
            $table->string('driving_licence_number', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('location_details');
        Schema::dropIfExists('rent_rates');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_details');
        Schema::dropIfExists('user_details');

        
    }
};
