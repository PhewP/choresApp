<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratings', function (Blueprint $table) {
            $table->id();
            $table->float('score')->nullable();
            $table->float('performance')->nullable();
            $table->float('speed')->nullable();
            $table->float('accuracy')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->foreignId('task_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratings');
    }
}
