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
        Schema::create('corses', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name',200);
            $table->string('seo_url')->unique();
            $table->integer('facultyId')->unsigned()->index();
            $table->string('category');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamps();

            $table->foreign('facultyId')->references('facultyId')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corses');
    }
};
