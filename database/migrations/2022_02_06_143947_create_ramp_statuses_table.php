<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRampStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramp_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status',50,)->unique();
            $table->timestamps();
        });
        Schema::table('ramps',function (Blueprint $table){
            $table->unsignedBigInteger('status')->nullable()->after('name');
            $table->foreign('status')->references('id')->on('ramp_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ramps',function (Blueprint $table){
            $table->dropForeign('ramps_status_foreign');
            $table->dropColumn('status');
        });
        Schema::dropIfExists('ramp_statuses');
    }
}
