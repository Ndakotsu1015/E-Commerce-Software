<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->double('old_price')->nullable();
            $table->double('new_price')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('shipping_returns')->nullable();
            $table->enum('status', ["Active", "Inactive"])->default('Active');
            $table->string('created_by')->nullable();
            $table->enum('is_delete', ["not", "deleted"])->default('not');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};