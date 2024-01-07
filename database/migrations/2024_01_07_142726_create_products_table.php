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
            $table->string('name');
            $table->float('price', 6, 2);
            $table->enum('so', ['Windows', 'Mac'])->nullable();
            $table->string('license', 100)->unique()->nullable();
            $table->string('sku', 10)->unique();
            $table->enum('type', [1, 2]);
            $table->enum('is_delete', ["0", "1"]);
            $table->timestamps();
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
    }
};
