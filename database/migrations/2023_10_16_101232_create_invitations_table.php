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
            $table->string('employee_email')->unique();
            $table->unsignedBigInteger('societe_id');
            $table->string('status')->default("Invitation n\'est pas encore confirmé.");
            $table->boolean('confirme')->default(0);
            $table->timestamps();
            $table->foreign('societe_id')
                ->references('id')
                ->on('societes')
                ->onDelete('cascade');
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
