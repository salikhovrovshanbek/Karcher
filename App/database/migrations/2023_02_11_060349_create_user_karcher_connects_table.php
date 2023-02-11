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
        Schema::create('user_karcher_connects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Karcher::class,"karcher_id");
            $table->foreignIdFor(\App\Models\User::class,"user_id");
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
        Schema::dropIfExists('user_karcher_connects');
    }
};
