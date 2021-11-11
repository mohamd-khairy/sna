<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBlogscommentsTable extends Migration
{
    public function up()
    {
        Schema::table('blogscomments', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->foreign('blog_id', 'blog_fk_4079387')->references('id')->on('blogs');
        });
    }
}
