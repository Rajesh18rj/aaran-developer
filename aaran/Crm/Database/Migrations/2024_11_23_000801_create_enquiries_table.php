<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('vname');  //mobile
            $table->string('whatsapp')->nullable();;
            $table->string('email')->nullable();
            //

            $table->string('body');
            $table->string('status_id',3)->nullable();
            $table->string('active_id',3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
