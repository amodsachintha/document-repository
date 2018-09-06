<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('form_id');
            $table->index('form_id');
            $table->string('form_name');
            $table->date('form_start_date')->nullable();
            $table->date('form_given_date')->nullable();
            $table->date('form_accepted_date')->nullable();
            $table->string('form_section')->nullable();
            $table->string('mf_no');
            $table->string('form_sender_name')->nullable();
            $table->string('form_receiver_name')->nullable();
            $table->string('form_recommender_name')->nullable();
            $table->date('to_be_destroyed')->nullable();
            $table->date('destroyed_on')->nullable();
            $table->boolean('lent')->default(false);
            $table->boolean('destroyed')->default(false);
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
        Schema::dropIfExists('documents');
    }
}
