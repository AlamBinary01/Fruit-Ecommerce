<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pictures')) {
            Schema::create('pictures', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->string('path');
                $table->timestamps();
        
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
        
    }

    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
