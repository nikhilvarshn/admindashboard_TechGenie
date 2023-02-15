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
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('mobile_no');
            $table->string('coll_name');
            $table->string('course_name');
            $table->string('dob');
            $table->string('gender');
            $table->string('plan_id');
            $table->string('purchase_date');
            $table->string('expire_date');
            $table->string('plan_status');
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
        Schema::dropIfExists('userdetails');
    }
};
