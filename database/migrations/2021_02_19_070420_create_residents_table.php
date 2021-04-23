<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('res_id');
            $table->string('res_last_name');
            $table->string('res_first_name');
            $table->string('res_middle_name')->nullable();
            $table->string('res_gender');
            $table->date('res_date_of_birth');
            $table->string('res_contact_number')->nullable();
            $table->string('res_barangay');
            $table->string('res_purok');
            $table->string('res_civil_status');
            $table->string('res_family_number');
            $table->string('res_qrcode_status');
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
        Schema::dropIfExists('residents');
    }
}
