<?php

namespace App\Models\Bcertify;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\User;
use App\Models\Bcertify\Formula;
use App\Models\Bcertify\TestBranch;
use App\Models\Bcertify\ProductCategory;

class ProductItem extends Model
{
    use Sortable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bcertify_product_items';

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
    protected $fillable = ['title', 'title_en', 'formula_id', 'test_branch_id', 'product_category_id', 'state', 'created_by', 'updated_by'];

    /*
      Sorting
    */
    public $sortable = ['title', 'title_en', 'formula_id', 'test_branch_id', 'product_category_id', 'state', 'created_by', 'updated_by'];

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

    /* Formula */
    public function formula(){
      return $this->belongsTo(Formula::class, 'formula_id');
    }

    /* Test Branch */
    public function test_branch(){
      return $this->belongsTo(TestBranch::class, 'test_branch_id');
    }

    /* Product Category */
    public function product_category(){
      return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function expertise(){
      return $this->hasMany(AuditorExpertise::class, 'product');
    }

    public function assessment(){
      return $this->hasMany(AuditorAssessmentExperience::class, 'product');
    }

}
