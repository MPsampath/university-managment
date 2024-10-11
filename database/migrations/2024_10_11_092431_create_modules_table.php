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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->unsigned()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();  // Not visible to students
            $table->enum('semester', ['1', '2', '3', '4', '5', '6', '7', '8']);
            $table->integer('credit');
            $table->enum('type', ['Mandatory', 'Elective']);
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('corses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
