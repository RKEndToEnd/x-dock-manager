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
            $table->string('name',5)->unique();
            $table->set('power',['Tak','Nie','Awaria']);
            $table->timestamps();
        });
        Schema::table('control_towers',function (Blueprint $table){
           $table->unsignedBigInteger('ramp')->nullable()->after('docked_at');
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
