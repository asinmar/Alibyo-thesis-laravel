<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('donation_id');
            $table->string('donation_quantity')->nullable();
            $table->string('donation_unit')->nullable();
            $table->string('donation_amount')->nullable();
            $table->string('donation_description')->nullable();
            $table->string('donation_type');
            $table->string('donation_status');
            $table->string('donation_recieved_by');
            $table->string('reason_to_delete')->nullable();
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->nullable()->references('donor_id')->on('donors')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

           
        });
        // Schema::create('donations', function (Blueprint $table){
        //     $table->foreign('donor_id')->nullable()->references('donor_id')->on('donors')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
