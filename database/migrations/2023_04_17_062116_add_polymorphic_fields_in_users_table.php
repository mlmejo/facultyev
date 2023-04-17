<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Use polymorphic relationships for instructor and student model.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('userable_id')->nullable();
            $table->string('userable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
