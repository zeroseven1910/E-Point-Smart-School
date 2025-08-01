// database/migrations/2024_01_01_000004_create_violations_and_achievements_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('violations_and_achievements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pelanggaran', 'prestasi']);
            $table->text('description');
            $table->integer('point');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('violations_and_achievements');
    }
};

