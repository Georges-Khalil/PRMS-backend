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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id('attachment_id');
            $table->unsignedBigInteger('task_id');
            $table->string('file_name');
            $table->binary('file_data');
            $table->string('file_type');
            $table->integer('file_size');
            $table->unsignedBigInteger('uploaded_by_user_id');
            $table->dateTime('upload_date');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('task_id')->references('task_id')->on('tasks')->onDelete('cascade');
            $table->foreign('uploaded_by_user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
