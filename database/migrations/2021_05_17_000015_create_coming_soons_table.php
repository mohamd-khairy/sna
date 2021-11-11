<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComingSoonsTable extends Migration
{
    public function up()
    {
        Schema::create('coming_soons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content_ar');
            $table->longText('content_en');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
