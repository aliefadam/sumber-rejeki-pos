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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaction_id");
            $table->string("product_name");
            $table->string("product_image")->nullable();
            $table->double("product_price");
            $table->double("qty");
            $table->string("abbr");
            $table->double("discount")->nullable();
            $table->double("product_new_price")->nullable();
            $table->double("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
