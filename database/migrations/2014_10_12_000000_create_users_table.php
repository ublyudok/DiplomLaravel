<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('password');
                $table->string('workplace');
                $table->string('telephone');
                $table->string('adress');
                $table->string('status');
                $table->string('avatar');
                $table->string('vk');
                $table->string('telegram');
                $table->string('instagram');
                $table->date('updated_at');
                $table->string('permissions')->default('user');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
