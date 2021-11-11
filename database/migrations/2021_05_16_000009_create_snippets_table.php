<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnippetsTable extends Migration
{
    public function up()
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->longText('content_ar');
            $table->longText('content_en');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
