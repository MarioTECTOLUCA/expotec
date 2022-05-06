<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('gender', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('careers', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('categories', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('items', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('score');
        });

        Schema::create('admins', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->time('time');
            $table->string('image')->unique();
            $table->date('date');
            $table->integer('status');
            $table->unsignedInteger('fk_admin')->nullable();
            $table->foreign('fk_admin')->references('id')->on('admins');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('noctrl')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('semester');
            $table->date('birthday');
            $table->integer('status');
            $table->integer('role');
            $table->unsignedInteger('fk_gender');
            $table->unsignedInteger('fk_career')->nullable();
            $table->foreign('fk_career')->references('id')->on('careers');
            $table->foreign('fk_gender')->references('id')->on('gender');
        });

        Schema::create('advisers', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status');
            $table->integer('role');
        });

        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('score');
            $table->unsignedInteger('fk_categorie');
            $table->foreign('fk_categorie')->references('id')->on('categories');
        });

        Schema::create('evaluators', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->integer('status');
            $table->unsignedInteger('fk_categorie');
            $table->unsignedInteger('fk_event');
            $table->foreign('fk_categorie')->references('id')->on('categories');
            $table->foreign('fk_event')->references('id')->on('events');
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status');
            $table->integer('vbo');
            $table->string('urldoc');
            $table->unsignedInteger('fk_adviser')->nullable();
            $table->unsignedInteger('fk_categorie');
            $table->unsignedInteger('fk_event');
            $table->integer('active_invitations')->nullable();
            $table->foreign('fk_adviser')->references('id')->on('advisers');
            $table->foreign('fk_categorie')->references('id')->on('categories');
            $table->foreign('fk_event')->references('id')->on('events');
        });

        Schema::create('students_has_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_student');
            $table->unsignedInteger('fk_teams');
            $table->foreign('fk_student')->references('id')->on('students');
            $table->foreign('fk_teams')->references('id')->on('teams');
        });

        Schema::create('evaluations_has_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_evaluations');
            $table->unsignedInteger('fk_items');
            $table->foreign('fk_evaluations')->references('id')->on('evaluations');
            $table->foreign('fk_items')->references('id')->on('items');
        });

        Schema::create('event_has_evaluators', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_evaluators');
            $table->unsignedInteger('fk_events');
            $table->foreign('fk_evaluators')->references('id')->on('evaluators');
            $table->foreign('fk_events')->references('id')->on('events');
        });

        Schema::create('requests', function (Blueprint $table){
            $table->increments('id');
            $table->date('requestdate');
            $table->unsignedInteger('fk_student')->nullable();
            $table->unsignedInteger('fk_adviser')->nullable();
            $table->unsignedInteger('fk_team')->nullable();
            $table->unsignedInteger('fk_admin')->nullable();
            $table->unsignedInteger('fk_evaluator')->nullable();
            $table->foreign('fk_student')->references('id')->on('students');
            $table->foreign('fk_adviser')->references('id')->on('advisers');
            $table->foreign('fk_team')->references('id')->on('teams');
            $table->foreign('fk_admin')->references('id')->on('admins');
            $table->foreign('fk_evaluator')->references('id')->on('evaluators');
        });
        
        Schema::create('comments', function (Blueprint $table){
            $table->increments('id');
            $table->longText('comment');
            $table->date('senddate');
            $table->unsignedInteger('fk_adviser')->nullable();
            $table->unsignedInteger('fk_team')->nullable();
            $table->foreign('fk_adviser')->references('id')->on('advisers');
            $table->foreign('fk_team')->references('id')->on('teams');
        });
      
        Schema::create('califications', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('fk_eva_has_items')->nullable();
            $table->unsignedInteger('fk_team')->nullable();
            $table->unsignedInteger('fk_evaluator')->nullable();
            $table->integer('score');
            $table->date('date');
            $table->foreign('fk_eva_has_items')->references('id')->on('evaluations_has_items');
            $table->foreign('fk_team')->references('id')->on('teams');
            $table->foreign('fk_evaluator')->references('id')->on('evaluators');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('careers');
        Schema::dropIfExists('gender');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('advisers');
        Schema::dropIfExists('categories');
    }
}
