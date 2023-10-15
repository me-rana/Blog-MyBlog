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
            $table->id();
            $table->String('title');
            $table->String('description',10000);
            $table->String('image_path')->nullable();
            $table->String('status');
            $table->String('slug');
            $table->String('tag');
            $table->bigInteger('author_id')->nullable()->default(12);
            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')
                         ->references('id')
                         ->on('categories')
                         ->onUpdate('cascade')
                         ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
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
