<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalkinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talkinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment')->nullable();
            $table->binary('fig')->nullable();
            $table->integer('userid')->nullable();
            $table->string('username')->nullable();
            $table->integer('groupid')->nullable();
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
        Schema::dropIfExists('talkinfos');
    }
}
