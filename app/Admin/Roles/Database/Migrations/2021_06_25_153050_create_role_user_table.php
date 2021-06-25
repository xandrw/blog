<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function(Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');

            $table->unique(['role_id', 'user_id'], 'unique_role_id_user_id');

            $table->foreign('role_id', 'foreign_role_id_roles_id')
                ->references('id')->on('roles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id', 'foreign_user_id_users_id')
                ->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
