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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('category');
            $table->string('question');
            $table->string('date_and_time');
            $table->string('ticket_status')->default('1');
            $table->string('mentor_id')->default('null');
            $table->string('google_meet_link')->default('null');
            $table->string('total_time_taken_to_solved_by_mentor')->default('null');
            $table->string('total_time_taken_to_solved_by_user')->default('null');
            $table->string('user_review')->default('null');
            $table->string('mentor_review')->default('null');

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
        Schema::dropIfExists('tickets');
    }
};
