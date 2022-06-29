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
        Schema::create('consumer_files', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('file_path');
            $table->text('file_name');
            $table->foreignId('consumer_id')->constrained('consumers')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('activation')->default(0)->comment('0 => waiting , 1 => inactive , 2 => active');
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
        Schema::dropIfExists('consumer_files');
    }
};
