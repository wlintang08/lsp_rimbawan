<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // CEK DULU, BARU TAMBAH
        if (!Schema::hasColumn('pendaftarans', 'is_read')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->boolean('is_read')->default(false);
            });
        }
    }

    public function down(): void
    {
        // CEK DULU, BARU HAPUS
        if (Schema::hasColumn('pendaftarans', 'is_read')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->dropColumn('is_read');
            });
        }
    }
};