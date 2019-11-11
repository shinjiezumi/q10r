<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSnsColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_id')->after('id');
            $table->string('avatar')->after('password');
			$table->string('email')->nullable()->change();
			$table->string('password')->nullable()->change();
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
			$table->string('password')->change();
			$table->string('email')->change();
			$table->dropColumn('avatar');
			$table->dropColumn('unique_id');
        });
    }
}
