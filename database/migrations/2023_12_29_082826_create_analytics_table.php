<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_table', function (Blueprint $table) {
            $table->id();
            $table->decimal('gross_profit', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('operational_cost', 10, 2);
            $table->decimal('nett_profit', 10, 2);
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
        Schema::dropIfExists('analytics_table');
    }
}
