<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('nilai_ujikoms', 'nilai_penguji2')) {
            return;
        }

        Schema::table('nilai_ujikoms', function (Blueprint $table) {
            $table->unsignedTinyInteger('nilai_penguji2')->default(0)->after('nilai_penguji1');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('nilai_ujikoms', 'nilai_penguji2')) {
            Schema::table('nilai_ujikoms', function (Blueprint $table) {
                $table->dropColumn('nilai_penguji2');
            });
        }
    }
};
