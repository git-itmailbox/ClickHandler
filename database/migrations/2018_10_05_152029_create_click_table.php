<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('user_agent');
            $table->string('ip');
            $table->string('ref')->nullable();
            $table->string('param1');
            $table->string('param2')->nullable();
            $table->integer('error')->default(0);
            $table->integer('bad_domain')->default(0);
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clicks');
    }
}
