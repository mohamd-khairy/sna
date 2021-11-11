<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('program')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('full_name_ar')->nullable();
            $table->string('national')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('undergraduate')->nullable();
            $table->string('degree')->nullable();
            $table->string('personal_statement')->nullable();
            $table->string('know_us')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->boolean('installment')->default(0)->nullable();
            $table->integer('installment_amount')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
