<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_towers', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id', 20);
            $table->bigInteger('track_id',20)->unique();
            $table->string('track_type',10);
            $table->bigInteger('freight',5);
            $table->dateTime('eta');
            $table->dateTime('docking_plan')->nullable();
            $table->dateTime('docked_at')->nullable();
            $table->dateTime('task_start')->nullable();
            $table->dateTime('task_end_exp')->nullable();
            $table->dateTime('doc_return_exp')->nullable();
            $table->dateTime('task_end')->nullable();
            $table->dateTime('doc_ready')->nullable();
            $table->string('comment',255)->nullable();
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
        Schema::dropIfExists('control_towers');
    }
}
