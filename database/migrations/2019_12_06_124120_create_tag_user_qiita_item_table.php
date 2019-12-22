<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagUserQiitaItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_user_qiita_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id');
            $table->bigInteger('user_qiita_item_id');
            $table->timestamps();

			$table->unique(['tag_id', 'user_qiita_item_id']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_user_qiita_item');
    }
}
