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
        Schema::create('portofolio_1061', function (Blueprint $table) {
            $table->id();
            $table->string('Judul', 100);
            $table->string('Deskripsi', 100);
            $table->date('Tahun')->nullable();
            $table->text('Link')->nullable();
            $table->string('Foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_1061');
    }
};
