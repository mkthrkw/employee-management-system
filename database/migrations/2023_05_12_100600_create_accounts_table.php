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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('employee_number')->unique();
            $table->string('name')->nullable();
            $table->string('name_kana')->nullable();
            $table->unsignedTinyInteger('position')->default(1);
            $table->string('email')->nullable();
            $table->foreignId('bc_route_id')->nullable()->constrained();
            $table->string('windows_username')->nullable();
            $table->string('chatwork_aid')->nullable();
            $table->unsignedTinyInteger('role')->default(1);
            $table->string('password');
            $table->date('joining_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->text('memo')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
