<?php

use App\Models\ReportFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_files', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(ReportFile::STATUS_MAKING);
            $table->string('filename')->nullable();
            $table->string('disk')->nullable();
            $table->foreignId('report_id');
            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('reports')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_files');
    }
};
