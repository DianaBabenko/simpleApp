<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('blog_tags', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');

            $table->bigInteger('taggable_id')->index();
            $table->string('taggable_type')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
    }
}
