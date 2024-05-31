<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Nnjeim\World\Database\Migrations\BaseMigration;

    class CreateCountriesTable extends BaseMigration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function (Blueprint $table) {
			$table->id();
			$table->string('iso2', 2);
			$table->string('name');
			$table->tinyInteger('status')->default(1);

      $table->string('phone_code', 5);
      $table->string('iso3', 3);
      $table->string('native')->nullable();
      $table->string('region');
      $table->string('subregion');
      $table->string('latitude')->nullable();
      $table->string('longitude')->nullable();
      $table->string('emoji')->nullable();
      $table->string('emojiU')->nullable();

			// foreach (config('world.migrations.countries.optional_fields') as $field => $value) {
			// 	if ($value['required']) {
			// 		$table->string($field, $value['length'] ?? null);
			// 	}
			// }
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('countries');
	}
}
