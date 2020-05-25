<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoujinshisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doujinshis', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('product_id');
            $table->string('book_name');
            $table->string('shop_page_url');
            $table->string('online_stock_status');
            $table->string('shop_name');
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
        Schema::dropIfExists('doujinshis');
    }
}
