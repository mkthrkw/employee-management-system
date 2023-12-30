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
        Schema::create('laptop_pcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained();
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('name')->nullable();
            $table->string('device_name')->nullable();
            $table->string('cpu')->nullable();
            $table->string('memory')->nullable();
            $table->unsignedTinyInteger('branch')->default(1);
            $table->date('arrival_date')->nullable();
            $table->date('disposal_date')->nullable();
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
        Schema::dropIfExists('laptop_pcs');
    }
};
