<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogscommentsTable extends Migration
{
    public function up()
    {
        Schema::create('blogscomments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('comment')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->timestamps();
        });
    }
}
