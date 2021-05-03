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
            $table->float('reward');
            $table->string('description');
            $table->timestamp('ini_date')   ->useCurrent();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('done_date')->nullable();
            $table->set('status', ['pending', 'in_progress', 'done']);
            $table->foreignId('id_creator')->constrained('users');
            $table->foreignId('id_performer')->constrained('users')
                ->nullable();
            $table->boolean('approved');
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
