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
        Schema::create('university_services', function (Blueprint $table)
        {
            $table->bigIncrements("id");
            $table->foreignId("university_id")->constrained("universities")->onDelete('cascade');
            $table->foreignId("service_id")->constrained("services")->onDelete('cascade');
            $table->double("price")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_services');
    }
};
