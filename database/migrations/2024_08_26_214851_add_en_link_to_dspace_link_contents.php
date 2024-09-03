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
        Schema::table('dspace_link_contents', function (Blueprint $table) {
           $table->string("content_title_en")->after("content_title");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dspace_link_contents', function (Blueprint $table) {
            //
        });
    }
};
