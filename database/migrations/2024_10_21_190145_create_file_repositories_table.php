<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_repositories', function (Blueprint $table) {
            $table->id();
            $table->integer('degree_id');
            $table->string('year');
            $table->string('semester');
            $table->string('title');
            $table->string('session');
            $table->string('file');
            $table->string('upload_year');
            $table->integer('rank')->nullable();

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
        Schema::dropIfExists('file_repositories');
    }
}
