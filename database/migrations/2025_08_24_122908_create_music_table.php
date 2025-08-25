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
        Schema::create('music', function (Blueprint $table) {
            $table->string('id');
            $table->string('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('music')->nullable();
            $table->longText('text')->nullable();
            // checking, confirmation, denial
            $table->string('role')->default('check');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
