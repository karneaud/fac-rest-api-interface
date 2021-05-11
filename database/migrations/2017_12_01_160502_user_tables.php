<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;

class UserTables extends Migration
{

	public function boot()
	{
    	Schema::defaultStringLength(191);
    	Builder::defaultStringLength(191);
	}
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::defaultStringLength(191);
    	Builder::defaultStringLength(191);
    
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('_id')->unique();
            $table->uuid('api_key')->unique()->nullable();
            $table->string('username',250)->unique();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email',250)->unique();
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->uuid('confirm_code');
            $table->dateTime('confirmed_at')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
    }
}
