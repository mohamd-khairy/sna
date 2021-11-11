<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id', 'job_fk_4155261')->references('id')->on('jobs');
        });
    }
}
