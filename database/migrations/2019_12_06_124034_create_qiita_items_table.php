<?php

use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQiitaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qiita_items', function (Blueprint $table) {
            $table->string('item_id')->primary();
            $table->string('item_title');
            $table->string('item_url');
            $table->json('item_tags');
            $table->string('item_user_id');
            $table->timestamp('item_created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('item_updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qiita_items');
    }
}
