<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQiitaApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qiita_api_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('qiita_account_id')->unsigned()->unique();
            $table->string('token', 255);
            $table->timestamps();

            $table->foreign('qiita_account_id')->references('id')->on('qiita_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qiita_api_tokens');
    }
}
