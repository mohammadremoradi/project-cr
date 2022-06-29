<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('first_clients', function (Blueprint $table) {
            $table->foreignId('tag_id')->nullable()->after('user_id')->constrained('tags')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('waiting')->default(0)->comment('0 => wait for registered, 1 => registerd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('first_clients', function (Blueprint $table) {
            //
        });
    }
};
