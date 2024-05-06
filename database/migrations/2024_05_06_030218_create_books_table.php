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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 50)->unique();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('publisher', 255);
            $table->string('cover', 255)->nullable();
            $table->year('year_published');
            $table->text('description')->nullable();
            $table->unsignedInteger('total_owned')->default(0);
            $table->unsignedInteger('total_borrow')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
