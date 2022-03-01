<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkerIdColumnToDeparturesControlTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departures_control_towers', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id')->after('ramp')->nullable();
            $table->foreign('worker_id')->references('id')->on('users');
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
            $table->dropForeign('departures_control_towers_worker_id_foreign');
            $table->dropColumn('worker_id');
        });
    }
}
