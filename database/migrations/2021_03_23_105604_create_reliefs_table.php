<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReliefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reliefs', function (Blueprint $table) {
            $table->bigIncrements('relief_id');
            $table->string('relief_name');
            $table->string('relief_quantity');
            $table->string('relief_status');
            $table->string('relief_remarks')->nullable();
            $table->string('relief_date_prepared');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reliefs');
    }
}
