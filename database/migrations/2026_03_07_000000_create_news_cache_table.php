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
        Schema::create('news_cache', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('link', 255); // URL (varchar 255 pour la compatibilité)
            $table->string('link_hash', 64)->unique(); // Hash SHA-256 pour l'unicité
            $table->string('image', 800)->nullable();
            $table->text('excerpt'); // 300 premiers caractères de content, HTML strippé
            $table->string('author', 255)->nullable();
            $table->string('source', 100);
            $table->dateTime('published_at');
            $table->timestamps();
            
            $table->index('published_at');
            $table->index('source');
            $table->index('link_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_cache');
    }
};
