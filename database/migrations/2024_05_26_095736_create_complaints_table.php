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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact1');
            $table->string('contact2')->nullable();
            $table->string('address');
            $table->string('product');
            $table->text('problem');
            $table->string('warranty_status');
            $table->string('purchased_from');
            $table->string('cancel_reason')->nullable();
            $table->string('model_photo');
            $table->string('complaint_number')->unique();
            $table->enum('status', ['pending', 'active', 'closed', 'unresolved', 'in_progress']);
            $table->integer('technician_id')->nullable();
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
        Schema::dropIfExists('complaints');
    }
};
