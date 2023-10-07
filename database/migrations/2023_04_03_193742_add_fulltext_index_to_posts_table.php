<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFulltextIndexToPostsTable extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE posts ADD FULLTEXT INDEX fulltext_post (title,content)');
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('fulltext_post');
        });
    }
}
