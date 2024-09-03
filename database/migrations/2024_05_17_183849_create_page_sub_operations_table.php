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
        Schema::create('page_sub_operations', function (Blueprint $table)
        {
            $table->bigIncrements("id");
            $table->foreignId("operation_id")->constrained("page_operations")->onDelete('cascade');
            $table->string("sub");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sub_operations');
    }
};
