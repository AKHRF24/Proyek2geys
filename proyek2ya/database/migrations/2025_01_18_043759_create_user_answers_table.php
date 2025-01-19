<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User ID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('question_id'); // Question ID
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->string('answer'); // User's Answer
            $table->boolean('is_correct')->default(false); // Indicates if the answer is correct
            $table->enum('status_question', ['pending', 'approved', 'rejected'])->default('pending'); // Validation status
            $table->timestamps(); // Created at and Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
