<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('temp_tags', function (Blueprint $table) {
            $table->increments('id');

            $table->string('taggable_type', 25);
            $table->unsignedBigInteger('taggable_id');
            $table->index(['taggable_type', 'taggable_id']);

            $table->string('note', 120)->nullable();
            $table->string('title', 30)->nullable();
            $table->timestamp('expired_at')->nullable()->index();

            $table->softDeletes();
            $table->timestamp('created_at')->nullable();

            $table->unique(['taggable_type', 'taggable_id', 'title', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_tags');
    }
}
