<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('channel')->default('default');
            $table->unsignedInteger('level');
            $table->string('level_name');
            $table->text('message');
            $table->json('context')->nullable();
            $table->json('extras')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('created_at', 3)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
