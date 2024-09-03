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
        Schema::create('services', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string("service_ar");
            $table->string("service_en")->nullable();
            $table->longText('description_ar');
            $table->longText('description_en')->nullable();
            $table->double("price");
            $table->boolean("stactus")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
