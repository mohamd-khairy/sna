<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLectureIdFieldToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('lecture_id')->nullable();
            // $table->foreign('lecture_id', 'lecture_fk_3459027')->references('id')->on('lectures');
        });
    }
}
