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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->string('project_title');
            $table->string('project_description');
            $table->date('start_date');
            $table->integer('company_code');
            $table->integer('completion_percentage')->default(0);
            $table->timestamps();

            // Define foreign key constraint to 'companies' table
            $table->foreign('company_code')->references('company_code')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
