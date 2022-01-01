<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique()->after('name');
            $table->string('tagline')->nullable()->after('username');
            $table->enum('sex', ['male', 'female', 'other'])->index()->after('tagline');
            $table->timestamp('birthdate')->nullable()->after('email_verified_at');
            $table->string('country')->nullable()->after('birthdate');
            $table->string('city')->nullable()->after('country');
            $table->mediumText('about')->nullable()->after('city');
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
            $table->dropColumn(['username', 'tagline', 'sex', 'birthdate', 'country', 'city', 'about']);
        });
    }
}
