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
        Schema::create('bc_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('display_memo1')->nullable();
            $table->string('display_memo2')->nullable();
            $table->string('display_memo3')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bc_routes');
    }
};
