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
        Schema::table('books', function (Blueprint $table) {
            $table->after('total_borrow', function ($table) {
                $table->string('created_by', 200)->default('System');
                $table->string('updated_by', 200)->default('System');
                $table->string('deleted_by', 200)->nullable();
            });
        });
        Schema::table('users', function (Blueprint $table) {
            $table->after('remember_token', function ($table) {
                $table->string('created_by', 200)->default('System');
                $table->string('updated_by', 200)->default('System');
                $table->string('deleted_by', 200)->nullable();
            });
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
};
