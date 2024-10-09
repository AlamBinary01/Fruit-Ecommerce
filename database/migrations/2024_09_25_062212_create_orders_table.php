<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                // User Details
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
                $table->string('first_name');
                $table->string('last_name');
                // $table->string('company_name');
                $table->string('address');
                $table->string('town_city');
                $table->string('country');
                $table->string('postcode_zip');
                $table->string('mobile');
                $table->string('email');
                // Total amount and payment method
                $table->decimal('total_amount', 10, 2);
                $table->string('payment_method')->nullable();
                $table->timestamps();
            });
        }

        // Create Order Products Pivot Table
        if (!Schema::hasTable('order_product')) {
            Schema::create('order_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->integer('quantity');
                $table->string('name'); // Storing product name
                $table->decimal('price', 10, 2); // Store the price if needed
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};
