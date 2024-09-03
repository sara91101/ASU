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
        Schema::create('committe_news', function (Blueprint $table)
        {
            $table->bigIncrements("id");
            $table->foreignId("committe_id")->constrained("committees")->onDelete('cascade');
            $table->longText('ar_news');
            $table->longText('en_news')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committe_news');
    }
};
