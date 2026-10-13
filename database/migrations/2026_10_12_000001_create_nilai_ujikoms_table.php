<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_ujikoms', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kelas', 20);
            $table->unsignedTinyInteger('nilai_penguji1');
            $table->unsignedTinyInteger('nilai_penguji2');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_ujikoms');
    }
};
