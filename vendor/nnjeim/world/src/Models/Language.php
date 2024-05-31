<?php

namespace Nnjeim\World\Models;

use Illuminate\Database\Eloquent\Model;
use Nnjeim\World\Models\Traits\WorldConnection;

class Language extends Model
{
    use WorldConnection;
    
	protected $fillable = [
		'code',
		'name',
		'name_native',
		'dir',
	];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('world.migrations.languages.table_name', parent::getTable());
	}
}
