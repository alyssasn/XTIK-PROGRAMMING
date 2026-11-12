<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_agenda', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('tbl_agenda', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
