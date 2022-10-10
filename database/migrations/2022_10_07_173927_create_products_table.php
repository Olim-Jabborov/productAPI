<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("price");
            $table->unsignedBigInteger("type_id")->nullable();
            $table->unsignedBigInteger("color_id")->nullable();
            $table->timestamps();
        });
        
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string("type_name");
            $table->timestamps();
        });
    
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string("color");
            $table->timestamps();
        });
        
        Schema::table('products', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('types');
        Schema::dropIfExists('colors');
    }
};
