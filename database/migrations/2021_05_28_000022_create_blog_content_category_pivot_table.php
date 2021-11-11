<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogContentCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_content_category', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->foreign('blog_id', 'blog_id_fk_4026706')->references('id')->on('blogs')->onDelete('cascade');
            $table->unsignedBigInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_4026706')->references('id')->on('content_categories')->onDelete('cascade');
        });
    }
}
