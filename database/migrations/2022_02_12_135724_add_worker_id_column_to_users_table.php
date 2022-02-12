<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkerIdColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('custom_id',5)->after('surname');
        });
        Schema::table('control_towers',function (Blueprint $table){
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
        Schema::table('control_towers',function (Blueprint $table){
        $table->dropForeign('users_worker_id_foreign');
        $table->dropColumn('worker_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('worker_id');
        });
    }
}
