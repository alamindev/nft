<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('name');
            $table->string('slug');
            $table->string('photo');
            $table->string('website_link')->nullable();
            $table->string('opensea_link')->nullable();
            $table->string('discord_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->date('launch_date');
            $table->time('launch_time');
            $table->longText('description');
            $table->string('timezone');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
