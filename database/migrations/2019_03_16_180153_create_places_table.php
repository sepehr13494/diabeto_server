<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category');
            $table->string('name')->collation('utf8_persian_ci');
            $table->float('lat',10,7);
            $table->double('long',10,7);
            $table->integer('startTime');
            $table->integer('endTime');
            $table->string('workDays');
            $table->text('address')->collation('utf8_persian_ci');
            $table->string('icons');
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
