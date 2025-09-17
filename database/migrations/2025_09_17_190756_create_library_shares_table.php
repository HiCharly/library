<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LibraryShareRole;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role');
            $table->timestamps();

            $table->unique(['library_id', 'user_id']);
            $table->index(['user_id', 'role']);
        });

        
        // Backfill existing owners into library_shares
        $libraries = DB::table('libraries')->select('id', 'user_id')->whereNotNull('user_id')->get();

        foreach ($libraries as $library) {
            // Insert owner share if not already present
            DB::table('library_shares')->insert([
                'library_id' => $library->id,
                'user_id' => $library->user_id,
                'role' => LibraryShareRole::Owner->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Drop foreign key and column libraries.user_id
        Schema::table('libraries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add user_id column
        Schema::table('libraries', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
        });

        // Backfill user_id from owner shares
        $owners = DB::table('library_shares')
            ->select('library_id', 'user_id')
            ->where('role', LibraryShareRole::Owner->value)
            ->get();

        foreach ($owners as $owner) {
            DB::table('libraries')->where('id', $owner->library_id)->update(['user_id' => $owner->user_id]);
        }

        Schema::dropIfExists('library_shares');
    }
};
