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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title'); // Title of the post
            $table->text('content'); // Main content of the post
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users
            $table->enum('status', ['published', 'draft', 'archived']);
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
