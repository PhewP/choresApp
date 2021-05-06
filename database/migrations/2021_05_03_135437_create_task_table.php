<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('reward');
            $table->text('description');
            $table->timestamp('ini_date')->useCurrent();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('done_date')->nullable();
            $table->set('status', ['pending', 'in_progress', 'done'])->default('pending');
            $table->foreignId('creator_id')->constrained('users');
            $table->foreignId('performer_id')->nullable()
                ->constrained('users');
            $table->boolean('approved')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tasks');
    }
}
