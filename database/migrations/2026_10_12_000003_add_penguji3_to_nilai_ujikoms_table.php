<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('nilai_ujikoms', 'nilai_penguji3')) {
            return;
        }

        Schema::table('nilai_ujikoms', function (Blueprint $table) {
            $table->unsignedTinyInteger('nilai_penguji3')->default(0)->after('nilai_penguji2');
        });

        DB::table('nilai_ujikoms')->update([
            'nilai_penguji3' => DB::raw('ROUND((nilai_penguji1 + nilai_penguji2) / 2)'),
        ]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('nilai_ujikoms', 'nilai_penguji3')) {
            Schema::table('nilai_ujikoms', function (Blueprint $table) {
                $table->dropColumn('nilai_penguji3');
            });
        }
    }
};
