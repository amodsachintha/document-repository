<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->date('form_start_date');
            $table->date('form_accepted_date');
            $table->string('form_section');
            $table->string('mf_no');
            $table->string('form_sender_name');
            $table->string('form_receiver_name');
            $table->string('form_recommender_name');
            $table->date('destroyed_on');
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
        Schema::dropIfExists('docs');
    }
}
