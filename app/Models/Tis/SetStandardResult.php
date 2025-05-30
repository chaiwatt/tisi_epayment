<?php

namespace App\Models\Tis;

use Illuminate\Database\Eloquent\Model;
use App\Models\Basic\StatusOperation;

class SetStandardResult extends Model
{
    protected $table = 'tis_set_standards_result';
    protected $primaryKey = 'id';
    protected $fillable = [
        'set_standard_plan_id',
        'statusOperation_id',
        'appointName_id',
        'meetingNo',
        'year',
        'quarter',
        'startdate',
        'enddate',
        'numpeople_g',
        'numpeople_subg',
        'numpeople_attendees',
        'allowances_referee_g',
        'allowances_referee_subg',
        'food_morning_attendees',
        'allowances_persident_g',
        'allowances_persident_subg',
        'food_noon_attendees',
        'food_afternoon_attendees',
        'sum_g',
        'sum_subg',
        'sum_attendees',
        'sum',
        'total',
        'created_at',
        'updated_at',
        'id_tis_set_standards'
    ];
    protected $dates = [
        'startdate', 'enddate'
    ];

    public function set_standard() {
        return $this->belongsTo(SetStandard::class, 'id_tis_set_standards');
    }

    public function set_standard_plan() {
        return $this->belongsTo(SetStandardPlan::class, 'set_standard_plan_id');
    }

    public function status_operation()
    {
        return $this->belongsTo(StatusOperation::Class, 'statusOperation_id');
    }

    public function strQuarter() {
        $arr = ['ไตรมาสที่ 1','ไตรมาสที่ 2','ไตรมาสที่ 3','ไตรมาสที่ 4'];
        return $arr[$this->quarter-1] ?? '';
    }

    public function totalAllowances() {
        return $this->allowances_referee_g + $this->allowances_referee_subg + $this->allowances_persident_g + $this->allowances_persident_subg;
    }

    public function totalFoods() {
        return $this->food_morning_attendees + $this->food_noon_attendees + $this->food_afternoon_attendees;
    }

    public function totalAllowances2() {
        return $this->sum_g + $this->sum_subg;
    }

    public function totalFoods2() {
        return $this->sum_attendees;
    }
}
