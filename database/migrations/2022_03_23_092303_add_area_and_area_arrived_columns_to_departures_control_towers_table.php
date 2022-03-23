<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaAndAreaArrivedColumnsToDeparturesControlTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departures_control_towers', function (Blueprint $table) {
            $table->integer('area')->default(0)->after('docking_plan')->nullable();
            $table->dateTime('area_arrived')->after('area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departures_control_towers', function (Blueprint $table) {
            $table->dropColumn('area_arrived');
            $table->dropColumn('area');
        });
    }
}
