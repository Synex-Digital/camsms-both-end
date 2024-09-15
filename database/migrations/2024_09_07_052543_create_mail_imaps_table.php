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
        Schema::create('mail_imaps', function (Blueprint $table) {
            $table->id();
            $table->string('imap_mailer')->nullable();
            $table->string('imap_host');
            $table->integer('imap_port');
            $table->string('imap_username');
            $table->string('imap_password');
            $table->string('imap_encryption')->nullable();
            $table->string('imap_protocol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_imaps');
    }
};
