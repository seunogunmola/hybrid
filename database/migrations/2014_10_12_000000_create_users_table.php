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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('post_town')->nullable();
            $table->string('post_code')->nullable();
            $table->enum('adult_cautions',['Yes','No'])->nullable();
            $table->enum('barred_from_children',['Yes','No'])->nullable();
            $table->enum('child_court_protection',['Yes','No'])->nullable();
            $table->enum('adult_court_protection',['Yes','No'])->nullable();
            $table->enum('childcare_cancellation',['Yes','No'])->nullable();
            $table->enum('residential_cancellation',['Yes','No'])->nullable();
            $table->enum('teaching_prohibition',['Yes','No'])->nullable();
            $table->enum('adult_prohibition',['Yes','No'])->nullable();
            $table->enum('barred_by_employer',['Yes','No'])->nullable();
            $table->enum('barred_by_professional_body',['Yes','No'])->nullable();
            $table->text('declaration_details')->nullable();
            $table->text('cv')->nullable();
            $table->text('supporting_statement')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->enum('role',['admin','vendor','user'])->default('user');
            $table->enum('status',['active','inactive'])->default('active');
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
