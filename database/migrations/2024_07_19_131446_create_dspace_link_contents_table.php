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
        Schema::create('dspace_link_contents', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("link_id")->constrained("dspace_links")->onDelete('cascade');
            $table->longText("content_title");
            $table->longText("content_path");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dspace_link_contents');
    }
};
