<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSuspendedByToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('suspended_by')->nullable();
            $table->string('suspended_date')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('suspended_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('deleted_by')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_suspended_by_foreign');
            $table->dropForeign('users_deleted_by_foreign');
            $table->dropColumn('suspended_by');
            $table->dropColumn('suspended_date');
            $table->dropColumn('deleted_by');
        });
    }
}
