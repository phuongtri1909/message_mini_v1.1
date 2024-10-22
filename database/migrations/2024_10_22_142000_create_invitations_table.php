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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade'); // Liên kết với conversation
            $table->foreignId('invited_user_id')->constrained('users')->onDelete('cascade'); // Người được mời
            $table->foreignId('invited_by')->constrained('users')->onDelete('cascade'); // Ai đã mời
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending'); // Trạng thái lời mời
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
