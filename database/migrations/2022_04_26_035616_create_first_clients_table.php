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
        Schema::create('first_clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->collation('utf8_general_ci');
            $table->string('age')->collation('utf8_general_ci');
            $table->string("degree")->collation('utf8_general_ci');
            $table->string('date_degree')->collation('utf8_general_ci');
            $table->string("language")->collation('utf8_general_ci');
            $table->string("job")->collation('utf8_general_ci');
            $table->string("money")->collation('utf8_general_ci');
            $table->string("phone")->unique();
            $table->enum('material', ['single', 'married'])->default('single');
            $table->integer('number_children')->default(0);
            $table->string("age_wife")->nullable()->collation('utf8_general_ci');
            $table->string('wife_degree')->nullable()->collation('utf8_general_ci');
            $table->string('wife_date_degree')->nullable()->collation('utf8_general_ci');
            $table->string("child1")->nullable()->collation('utf8_general_ci');
            $table->string("child2")->nullable()->collation('utf8_general_ci');
            $table->string("child3")->nullable()->collation('utf8_general_ci');
            $table->string("child4")->nullable()->collation('utf8_general_ci');
            $table->string("child5")->nullable()->collation('utf8_general_ci');
            $table->string("child6")->nullable()->collation('utf8_general_ci');
            $table->string('about_us');
            $table->text('discription')->collation('utf8_general_ci')->nullable();
            $table->date('next_call')->nullable();
            $table->enum('status', ['consulting', 'done', 'cancel'])->default('consulting');
            $table->enum('intrest', ['0%', '50%', '75%'])->default('50%');
            $table->integer("hours")->nullable()->default(0);
            $table->string("cansultant_name")->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('first_clients');
    }
};
