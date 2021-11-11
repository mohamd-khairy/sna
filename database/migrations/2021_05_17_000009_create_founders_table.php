<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundersTable extends Migration
{
    public function up()
    {
        Schema::create('founders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->string('department');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
