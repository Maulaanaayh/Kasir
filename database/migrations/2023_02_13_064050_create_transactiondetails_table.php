<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactiondetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedbigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('qty');
            $table->integer('subtotal');
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
        Schema::dropIfExists('transactiondetails');
    }
};
