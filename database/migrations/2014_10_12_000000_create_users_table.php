<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id')->nullable();
            $table->string('researchInt')->nullable();
            $table->string('institute')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('photo')->nullable();
            $table->enum('role',['admin', 'stuff', 'student','false'])->default('false');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('phone')-> nullable();
            $table->string('password');
            $table->string('designation')-> nullable();

            $table->string('special_desig')-> nullable();
            $table->string('dept')-> nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
