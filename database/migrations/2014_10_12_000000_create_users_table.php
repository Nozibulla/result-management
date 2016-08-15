<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('students', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('class');
			$table->string('roll');
			$table->string('batch');
			$table->string('shift');
			$table->string('year');
			$table->string('mobile');
			$table->timestamps();
		});

		Schema::create('subjects', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('classes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('batches', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('shifts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('dailyresults', function (Blueprint $table) {
			$table->increments('id');
			$table->string('month');
			$table->string('subject');
			$table->string('one')->default(0);
			$table->string('two')->default(0);
			$table->string('three')->default(0);
			$table->string('four')->default(0);
			$table->string('five')->default(0);
			$table->string('six')->default(0);
			$table->string('seven')->default(0);
			$table->string('eight')->default(0);
			$table->string('nine')->default(0);
			$table->string('ten')->default(0);
			$table->string('eleven')->default(0);
			$table->string('twelve')->default(0);
			$table->string('thirteen')->default(0);
			$table->string('fourteen')->default(0);
			$table->string('fifteen')->default(0);
			$table->string('sixteen')->default(0);
			$table->string('seventeen')->default(0);
			$table->string('eighteen')->default(0);
			$table->string('nineteen')->default(0);
			$table->string('twenty')->default(0);
			$table->string('twentyone')->default(0);
			$table->string('twentytwo')->default(0);
			$table->string('twentythree')->default(0);
			$table->string('twentyfour')->default(0);
			$table->string('twentyfive')->default(0);
			$table->string('twentysix')->default(0);
			$table->string('twentyseven')->default(0);
			$table->string('twentyeight')->default(0);
			$table->string('twentynine')->default(0);
			$table->string('thirty')->default(0);
			$table->string('thirtyone')->default(0);
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users');
		Schema::drop('students');
		Schema::drop('dailyresults');
		Schema::drop('subjects');
		Schema::drop('classes');
		Schema::drop('batches');
		Schema::drop('shifts');
	}
}
