<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramps', function (Blueprint $table) {
            $table->id();
            $table->string('name',5);
            $table->string('status',50);
            $table->set('power',['Tak','Nie']);
            $table->timestamps();
        });
        Schema::table('control_towers',function (Blueprint $table){
           $table->unsignedBigInteger('ramp')->after('docked_at')->nullable();
           $table->foreign('ramp')->references('id')->on('ramps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control_towers',function (Blueprint $table){
            $table->dropForeign('control_towers_ramp_foreign');
            $table->dropColumn('ramp');
        });
        Schema::dropIfExists('ramps');
    }
}
