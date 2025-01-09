<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTotalPriceNullableInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Make total_price nullable
            $table->decimal('total_price', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // If you need to reverse the migration, make total_price not nullable
            $table->decimal('total_price', 8, 2)->nullable(false)->change();
        });
    }
}
