<?php

namespace App\Models\Certify\ApplicantCB;

use HP;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certify\MessageRecordTransaction;
use App\Models\Bcertify\CbBoardAuditorMsRecordInfo;

class CertiCBAuditors  extends Model
{
    protected $table = 'app_certi_cb_auditors';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'app_certi_cb_id',
                            'no',
                            'auditor',
                             'vehicle',
                             'status',
                            'state',
                            'step_id',
                            'created_by',
                            'updated_by',
                            'status_cancel',
                            'reason_cancel',
                            'created_cancel',
                            'date_cancel',
                            'is_review_state',
                            'message_record_status',
                            'cb_auditor_team_id'
                          ];
   
 public function CertiCbCostTo()
 {
     return $this->belongsTo(CertiCb::class,'app_certi_cb_id');
 }
  // pay in 
  public function CertiCBPayInOneTo()
   {
      return $this->belongsTo(CertiCBPayInOne::class,'id','auditors_id')->whereNotNull('conditional_type');
  } 
  public function UserCancelTo()
  {
      return $this->belongsTo(User::class,'created_cancel','runrecno');
  }   
 public function UserTo()
 {
     return $this->belongsTo(User::class,'created_by','runrecno');
 }   
 public function CertiCBAuditorsDates()
 {
     return $this->hasMany(CertiCBAuditorsDate::class, 'auditors_id');
 }

 public function app_certi_cb_auditors_date() {
    return $this->hasOne(CertiCBAuditorsDate::class, 'auditors_id','id')->orderby('id','desc');
}
 
 public function CertiCBAuditorsCosts()
 {
     return $this->hasMany(CertiCBAuditorsCost::class, 'auditors_id');
 }
 
 public function CertiCBAuditorsLists()
 {
     return $this->hasMany(CertiCBAuditorsList::class, 'auditors_id');
 }
 public function CertiCbHistorys()
 {
     $tb = new CertiCBAuditors;
     return $this->hasMany(CertiCbHistory::class, 'ref_id')
               ->where('table_name',$tb->getTable()) 
               ->where('system',5);
 }

 public function FileAuditors1()
 {
    $tb = new CertiCBAuditors;
    return $this->belongsTo(CertiCBAttachAll::class,'id','ref_id')
                ->select('id','file','file_client_name')
                ->where('table_name',$tb->getTable())
                ->where('file_section',1);
 }  
 public function FileAuditors2()
 {
    $tb = new CertiCBAuditors;
    return $this->belongsTo(CertiCBAttachAll::class,'id','ref_id')
                ->select('id','file','file_client_name')
                ->where('table_name',$tb->getTable())
                ->where('file_section',2);
 }    
 
 public function getStatusTitleAttribute() {
    $list = '';
      if($this->status == null){
          $list =  'ขอความเห็นการแต่งตั้งคณะผู้ตรวจประเมิน';
      }elseif($this->status == 1){
          $list =  'เห็นชอบการแต่งตั้งคณะผู้ตรวจประเมิน';
       }elseif($this->status == 2){
        $list =  'ไม่เห็นชอบการแต่งตั้งคณะผู้ตรวจประเมิน';
      }
      
      return  $list ?? '-';
   }
 public function getCertiCBAuditorsDateTitleAttribute() {
    $data = HP::getArrayFormSecondLevel($this->CertiCBAuditorsDates->toArray(), 'id');
    $datas = CertiCBAuditorsDate::select('start_date','end_date')->whereIn('id', $data)->get();
    $strMonthCut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    foreach ($datas as $key => $list) {
          if(!is_null($list->start_date) &&!is_null($list->end_date)){
             // ปี
             $StartYear = date("Y", strtotime($list->start_date)) +543;
             $EndYear = date("Y", strtotime($list->end_date)) +543;
            // เดือน
            $StartMonth= date("n", strtotime($list->start_date));
            $EndMonth= date("n", strtotime($list->end_date));
            //วัน
            $StartDay= date("j", strtotime($list->start_date));
            $EndDay= date("j", strtotime($list->end_date));
            if($StartYear == $EndYear){
                if($StartMonth == $EndMonth){
                      if($StartDay == $EndDay){
                        $datas[$key] =  $StartDay.' '.$strMonthCut[$StartMonth].' '.$StartYear ;
                      }else{
                        $datas[$key] =  $StartDay.'-'.$EndDay.' '.$strMonthCut[$StartMonth].' '.$StartYear ;
                      }
                }else{
                    $datas[$key] =  $StartDay.' '.$strMonthCut[$StartMonth].' '.$StartYear.' - '.$EndDay.' '.$strMonthCut[$EndMonth].' '.$EndYear ;
                }
            }else{
                $datas[$key] =  $StartDay.' '.$strMonthCut[$StartMonth].' '.$StartYear.' - '.$EndDay.' '.$strMonthCut[$EndMonth].' '.$EndYear ;
            }
         }
    }
    return implode(", ", json_decode($datas,true));
  }

  public function getStartDateBoardAuditorAttribute() {
    $data = HP::getArrayFormSecondLevel($this->CertiCBAuditorsDates->toArray(), 'id');
    $start_date = CertiCBAuditorsDate::select('start_date','end_date')->whereIn('id', $data)->orderby('start_date','asc')->first();
    return  !is_null($start_date) ? $start_date : null;
  }


  public function getSumCostConFirmAttribute() {
    $data = $this->CertiCBAuditorsCosts;
    $countItem = 0;
    if(count($data) > 0){
        foreach($data as $item){
            $countItem += $item->amount * $item->amount_date;
        }
    }
    return number_format($countItem,2) ?? 0;
   }
   
    //  สถานะขั้นตอนการทำงาน
    public function CertiCBAuditorsStepTo()
    {
        return $this->belongsTo(CertiCBAuditorsStep::class,'step_id');
    }

    public function certiCBSaveAssessment()
    {
        return CertiCBSaveAssessment::where('auditors_id',$this->id)->first();
    }

    public function cbBoardAuditorMsRecordInfos()
    {
        return $this->hasOne(CbBoardAuditorMsRecordInfo::class,'board_auditor_id');
    }
    public function messageRecordTransactions()
    {
        return $this->hasMany(MessageRecordTransaction::class, 'board_auditor_id')->where('certificate_type',0);
    }
    
}
