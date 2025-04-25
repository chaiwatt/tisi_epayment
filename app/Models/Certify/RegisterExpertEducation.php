<?php

namespace App\Models\Certify;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\AttachFile;
class RegisterExpertEducation extends Model
{
    use Sortable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register_expert_education';

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
    protected $fillable = ['expert_id', 'year', 'education_id', 'academy', 'faculty'];

    /*
      Sorting
    */
    public $sortable = ['expert_id', 'year', 'education_id', 'academy', 'faculty'];

    public function AttachFileEducationTo()
    { 
        return $this->belongsTo(AttachFile::class,'id','ref_id')->where('ref_table',$this->table)->where('section','file_education')->orderby('id','desc');
    }

 

}
