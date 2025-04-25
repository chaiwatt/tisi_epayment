<?php

namespace App\Models\Esurv;

use Illuminate\Database\Eloquent\Model;
use App\Models\Basic\UnitCode;

class Applicant20TerProductDetail extends Model
{
	protected $table = 'esurv_applicant_20ter_product_details';

	/**
	 * The database primary key value.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['detail', 'quantity', 'id_unit', 'unit', 'unit_other', 'applicant_20ter_id'];

	public function data_unit(){
		return $this->belongsTo(UnitCode::class, 'id_unit', 'id_unit');
	}

	public function informed(){
		return $this->hasMany(Volume20TerProductDetail::class, 'detail_id', 'id');
	}

}
