<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->unique();
            $table->string('city',255);
            $table->text('map_link')->nullable();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('depot_id')->nullable()->after('email');
            $table->foreign('depot_id')->references('id')->on('depots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_depot_id_foreign');
            $table->dropColumn('depot_id');
        });
        Schema::dropIfExists('depots');
    }
}
