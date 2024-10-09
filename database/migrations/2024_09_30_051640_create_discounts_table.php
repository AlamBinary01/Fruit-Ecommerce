<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        if(!Schema::hasTable('discounts')) {
            Schema::create('discounts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->string('discount_type'); 
                $table->decimal('discount_value', 10, 2);
                $table->date('start_date')->nullable(); 
                $table->date('end_date')->nullable(); 
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
