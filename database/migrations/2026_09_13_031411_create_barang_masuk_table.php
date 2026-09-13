<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                  ->constrained('items')
                  ->onDelete('cascade');

            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang_masuk');
    }
};