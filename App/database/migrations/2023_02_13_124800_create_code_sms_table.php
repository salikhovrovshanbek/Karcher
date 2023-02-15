<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_sms', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');
            $table->string('phone');
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->integer('code')->unique();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_sms');
    }
};
