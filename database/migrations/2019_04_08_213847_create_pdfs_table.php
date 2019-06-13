<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdfs', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('creator_id');
			$table->string('pdf_name');
			//$table->string('password'); //Being replaced with a user-pdf permissions table
			//$table->longtext('pdf')->nullable(); //Using local storage instead
            //$table->timestamp('pdf_uploaded_at')->nullable();
			$table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf');
    }
}
