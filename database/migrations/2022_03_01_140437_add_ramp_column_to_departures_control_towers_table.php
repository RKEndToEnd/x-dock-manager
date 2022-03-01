<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRampColumnToDeparturesControlTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departures_control_towers', function (Blueprint $table) {
            $table ->unsignedBigInteger('ramp')->after('docked_at')->nullable();
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
        Schema::table('departures_control_towers', function (Blueprint $table) {
            $table->dropForeign('departures_control_towers_ramp_foreign');
            $table->dropColumn('ramp');
        });
    }
}
