<?php

namespace App\Models\Bcertify;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\User;

class Formula extends Model
{
    use Sortable;
    
    protected static $minSlugLength = 10;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bcertify_formulas';

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
    protected $fillable = ['title', 'title_en', 'applicant_type', 'state', 'created_by', 'updated_by','condition_th','condition_en','tis_no'];

    /*
      Sorting
    */
    public $sortable = ['title', 'title_en', 'applicant_type', 'state', 'created_by', 'updated_by','condition_th','condition_en','tis_no'];



    /*
      User Relation
    */
    public function user_created(){
      return $this->belongsTo(User::class, 'created_by');
    }

    public function user_updated(){
      return $this->belongsTo(User::class, 'updated_by');
    }

    public function getCreatedNameAttribute() {
        return !is_null($this->user_created) ? $this->user_created->reg_fname.' '.$this->user_created->reg_lname : '-' ;
    }

    public function getUpdatedNameAttribute() {
  		return @$this->user_updated->reg_fname.' '.@$this->user_updated->reg_lname;
  	}

    public function expertise()
    {
        return $this->hasMany(AuditorExpertise::class, 'standard');
    }

    public function assessment()
    {
        return $this->hasMany(AuditorAssessmentExperience::class, 'standard');
    }
}
