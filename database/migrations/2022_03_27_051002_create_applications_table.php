<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_name');
            $table->string('application_website');
            $table->string('application_summary')->nullable();
            $table->string('application_body')->nullable();
            $table->string('application_thumbnail')->nullable();
            $table->string('application_status')->default('ongoing');
            $table->bigInteger('application_priority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
