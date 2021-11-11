<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->string('street_address');
            $table->string('city');
            $table->string('post_code');
            $table->string('email_address');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('linked_in_profile');
            $table->string('highest_degree')->nullable();
            $table->string('field_of_study');
            $table->string('institute');
            $table->string('country');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('high_school_name');
            $table->string('certificate_type');
            $table->string('grade');
            $table->longText('comments')->nullable();
            $table->string('history_title');
            $table->string('history_type_of_institute');
            $table->string('history_city');
            $table->string('history_country');
            $table->date('history_start_date');
            $table->datetime('history_end_date');
            $table->longText('history_reason_of_leaving');
            $table->string('current_notice_period');
            $table->longText('best_candidate')->nullable();
            $table->string('nationality');
            $table->string('race');
            $table->string('age_groups')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion');
            $table->string('disability')->nullable();
            $table->string('disability_yes')->nullable();
            $table->string('know_us')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
