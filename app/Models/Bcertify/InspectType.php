<?php

namespace App\Models\Bcertify;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\User;

class InspectType extends Model
{
    use Sortable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bcertify_inspect_types';

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
    protected $fillable = ['title', 'title_en', 'description', 'state', 'created_by', 'updated_by'];

    /*
      Sorting
    */
    public $sortable = ['title', 'title_en', 'description', 'state', 'created_by', 'updated_by'];

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
        return $this->hasMany(AuditorExpertise::class, 'type_of_examination');

    }
    public function assessment()
    {
        return $this->hasMany(AuditorAssessmentExperience::class, 'type_of_examination');

    }
}
