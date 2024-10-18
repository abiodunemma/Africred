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
        Schema::table('movies', function (Blueprint $table) {
          //  $table->index('user_id');
            $table->unsignedBigInteger('user_id')->after('genre'); // Add user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Optional: set up foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key if you added one
            $table->dropColumn('user_id'); // Drop the column
        });
    }
};
