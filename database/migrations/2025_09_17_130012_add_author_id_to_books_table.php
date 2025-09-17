<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('author_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
        });

        DB::transaction(function () {
            $names = DB::table('books')->whereNotNull('author')
                        ->distinct()->pluck('author');

            foreach ($names as $name) {
                DB::table('authors')->updateOrInsert(
                    ['name' => $name],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }

            $books = DB::table('books')->select('id','author')->get();
            foreach ($books as $b) {
                if (!$b->author) continue;
                $authorId = DB::table('authors')->where('name', $b->author)->value('id');
                if ($authorId) {
                    DB::table('books')->where('id', $b->id)->update(['author_id' => $authorId]);
                }
            }
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('author');
        });

        // DB::statement('ALTER TABLE books MODIFY author_id BIGINT UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->dropConstrainedForeignId('author_id');
        });

        DB::table('books')
            ->join('authors','authors.id','=','books.author_id')
            ->update(['books.author' => DB::raw('authors.name')]);
    }
};
