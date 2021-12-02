<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->string('description')->nullable();
        $table->string('logo')->nullable();
        $table->string('logo_sm')->nullable();

        $table->string('primary_email')->nullable();
        $table->string('secondary_email')->nullable();
        $table->string('hunting_line')->nullable();
        $table->string('contact')->nullable();
        $table->string('address')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->timestamps();

        $table->foreign('updated_by')
          ->references('id')
          ->on('users')
          ->onDelete('set null');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
