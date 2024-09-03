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
        Schema::create('coalitions', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->longText('home_ar');
            $table->longText('home_en')->nullable();
            $table->string("home_type");
            $table->string("home_image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coalitions');
    }
};
