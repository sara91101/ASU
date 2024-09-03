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
        Schema::create('committe_members', function (Blueprint $table)
        {
            $table->bigIncrements("id");
            $table->foreignId("committe_id")->constrained("committees")->onDelete('cascade');
            $table->foreignId("university_id")->constrained("universities")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committe_members');
    }
};
