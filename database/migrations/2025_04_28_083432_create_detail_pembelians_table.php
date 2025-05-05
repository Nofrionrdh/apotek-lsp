<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->foreign('id_obat')->references('id')->on('obats')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_beli'); 
            $table->double('harga_beli'); 
            $table->double('subtotal'); 
            $table->unsignedBigInteger('id_pembelian');
            $table->foreign('id_pembelian')->references('id')->on('pembelianS')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
