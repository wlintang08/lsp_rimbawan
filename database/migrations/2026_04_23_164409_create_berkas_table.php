<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('berkas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();
        $table->string('nama_berkas'); // contoh: KTP, Ijazah
        $table->string('file');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
