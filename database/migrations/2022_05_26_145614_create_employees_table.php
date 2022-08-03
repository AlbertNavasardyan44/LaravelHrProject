<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('application_date');
            $table->date('interview_date');
            $table->string('name_last_name');
            $table->date('birth_date');
            $table->string('profession');
            $table->integer('education_id');
            //$table->integer('experience_id');
            $table->string('comments');
            $table->string('contacts');
            $table->string('social_sites');
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
        Schema::dropIfExists('employees');
    }
}
