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
        Schema::create('committee_tasks', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("committe_id")->constrained("committees")->onDelete('cascade');
            $table->longText('ar_task');
            $table->longText('en_task')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_tasks');
    }
};
