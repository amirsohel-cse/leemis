<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('sku')->nullable();
            $table->string('product_type')->nullable();
            $table->string('affiliate_link')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('childcategory_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('attributes')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('photo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('file')->nullable();
            $table->string('size')->nullable();
            $table->string('size_qty')->nullable();
            $table->string('size_price')->nullable();
            $table->string('color')->nullable();
            $table->string('price')->nullable();
            $table->float('previous_price')->nullable();
            $table->float('cash_back')->nullable();
            $table->float('product_commission')->nullable();
            $table->string('tax')->nullable();
            $table->string('details')->nullable();
            $table->string('vat')->nullable();
            $table->string('stock')->nullable();
            $table->string('policy')->nullable();
            $table->string('status')->default(0);
            $table->string('views')->nullable();
            $table->string('tags')->nullable();
            $table->string('features')->nullable();
            $table->string('colors')->nullable();
            $table->string('product_condition')->nullable();
            $table->string('ship')->nullable();
            $table->string('is_meta')->default(0);
            $table->string('meta_tag')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('youtube')->nullable();
            $table->string('type')->nullable();
            $table->string('license')->nullable();
            $table->string('license_qty')->nullable();
            $table->string('link')->nullable();
            $table->string('platform')->nullable();
            $table->string('region')->nullable();
            $table->string('licence_type')->nullable();
            $table->float('measure')->nullable();
            $table->string('featured')->default(0);
            $table->string('best')->default(0);
            $table->string('top')->default(0);
            $table->string('hot')->default(0);
            $table->string('latest')->default(0);
            $table->string('big')->default(0);
            $table->string('offer_product')->default(0);
            $table->string('trending')->default(0);
            $table->string('sale')->default(0);
            $table->double('avg_rating')->nullable();
            $table->boolean('online_payment')->default(0);

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
}
