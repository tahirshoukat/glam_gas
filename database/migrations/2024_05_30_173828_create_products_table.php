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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact1');
            $table->string('contact2')->nullable();
            $table->string('address');
            $table->string('product_category');
            $table->string('barcode');
            $table->text('product_details');
            $table->enum('status', ['active', 'closed', 'unresolved', 'in_progress']);
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
        Schema::dropIfExists('products');
    }
};
