<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDistancesTable.
 */
class CreateDistancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('distances', function(Blueprint $table) {
            $table->increments('id');
			$table->mediumInteger('postcode_origin');
			$table->mediumInteger('postcode_destiny');
			$table->longText('calculated_distance');
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
		Schema::drop('distances');
	}
}
