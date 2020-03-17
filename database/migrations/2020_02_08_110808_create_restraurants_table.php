<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestraurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restraurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('restaurant_name')->nullable();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('business_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restraurants');
    }
}
