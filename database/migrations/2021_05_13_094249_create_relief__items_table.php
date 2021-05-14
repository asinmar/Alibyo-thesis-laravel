<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReliefItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relief__items', function (Blueprint $table) {
            $table->bigIncrements('ri_id');
            $table->bigInteger('ri_quantity');
            $table->string('ri_unit');
            $table->string('ri_description');
            $table->unsignedBigInteger('relief_id');
            $table->foreign('relief_id')->nullable()->references('relief_id')->on('reliefs')->onDelete('cascade');
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
        Schema::dropIfExists('relief__items');
    }
}
