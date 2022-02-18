<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->after('depot_id');
        });
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign('model_has_roles_model_id_foreign');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
