<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogContentTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_content_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->foreign('blog_id', 'blog_id_fk_4026707')->references('id')->on('blogs')->onDelete('cascade');
            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_4026707')->references('id')->on('content_tags')->onDelete('cascade');
        });
    }
}
