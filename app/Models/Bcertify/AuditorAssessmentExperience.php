<?php

namespace App\Models\Bcertify;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Bcertify\CertificationBranch; // CB
use App\Models\Bcertify\InspectBranch;  // IB
use App\Models\Bcertify\CalibrationBranch;  // LAB สอบเทียบ
use App\Models\Bcertify\TestBranch;  // LAB ทดสอบ
use App\Models\Bcertify\Formula;
class AuditorAssessmentExperience extends Model
{
    use Sortable; 
    protected $table = "auditor_assessment_experiences";
    protected $fillable = [
        'auditor_id',
        'start_date',
        'end_date',
        'type_of_assessment',
        'standard',
        'branch_id',
        'branch_path',
        'scope_name',
        'scope_path',
        'type_of_examination',
        'examination_category',
        'calibration_list',
        'product',
        'test_list',
        'role',
        'auditor_status',
        'token',
    ];

    public function auditor(){
        return $this->belongsTo(AuditorInformation::class, 'auditor_id');

    }

    public function formula()
    {
        return $this->belongsTo(Formula::class, 'standard');
    }

    public function type(){
        return $this->belongsTo(InspectType::class, 'type_of_examination');
    }

    public function category(){
        return $this->belongsTo(InspectCategory::class, 'examination_category');
    }

    public function calibration(){
        return $this->belongsTo(CalibrationItem::class, 'calibration_list');
    }

    public function product_show(){
        return $this->belongsTo(ProductItem::class, 'product');
    }

    public function test(){
        return $this->belongsTo(TestItem::class, 'test_list');
    }


    public function statusAuditor(){
        return $this->belongsTo(StatusAuditor::class, 'auditor_status');
    }

    public function branchable()
    {
        return $this->morphTo(null, 'branch_path', 'branch_id');
    }

    public function certification_branch_to(){
        return $this->belongsTo(CertificationBranch::class, 'branch_id');
    }
    public function inspect_branch_to(){
        return $this->belongsTo(InspectBranch::class, 'branch_id');
    }
    public function calibration_branch_to(){
        return $this->belongsTo(CalibrationBranch::class, 'branch_id');
    }
    public function test_branch_to(){
        return $this->belongsTo(TestBranch::class, 'branch_id');
    }


    // สาขา
    public function getBranchTitleToAttribute()
    {
        $data = '';
        if(!is_null($this->type_of_assessment) ){
            if($this->type_of_assessment == 1){ // CB
                $data = @$this->certification_branch_to->title;
            } else if($this->type_of_assessment == 2){ // IB
                $data = @$this->inspect_branch_to->title;
            } else if($this->type_of_assessment == 3){ //  LAB สอบเทียบ
                $data = @$this->calibration_branch_to->title;
            } else if($this->type_of_assessment == 4){ // LAB ทดสอบ
                $data = @$this->test_branch_to->title;
            } 
        } 
        return $data;
    }

      // ขอบข่าย
        public function getScopeTitleToAttribute()
        {
             $information_scope = null;
             $scope = CertificationScope::where('certification_branch_id',$this->branch_id)->first();
            if(!is_null($this->type_of_assessment)  && !is_null($scope)   ){
                if($this->type_of_assessment == 1){ // CB
                     if ($scope->scope_type == "ISIC"){
                            $information_scope = IndustryType::where('id',$this->scope_name)->first();  
                        }
                     elseif ($scope->scope_type == "IAF"){
                            $information_scope = Iaf::where('id',$this->scope_name)->first();  
                        }
                    elseif ($scope->scope_type == "Enms"){
                            $information_scope = Enms::where('id',$this->scope_name)->first();  
                        }
                    elseif ($scope->scope_type == "GHG"){
                            $information_scope = Ghg::where('id',$this->scope_name)->first();  
                        }
                } 
            } 
            return  !is_null($information_scope) ?  $information_scope->title : '';
        }




}
