<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('social_links', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('url');
        $table->string('slug');
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->timestamps();


        $table->foreign('created_by')
          ->references('id')
          ->on('users')
          ->onDelete('set null');

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
        Schema::dropIfExists('social_links');
    }
}
