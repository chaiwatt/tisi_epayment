<?php

namespace App\Models\Certificate;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\CertificateExport;
use App\AttachFile;
use App\Models\Certify\ApplicantCB\CertiCBExport;
use App\Models\Certify\ApplicantIB\CertiIBExport;
class  TrackingReview extends Model
{
    use Sortable;
    protected $table = "app_certi_tracking_review";
    protected $primaryKey = 'id';
    protected $fillable = ['tracking_id','certificate_type', 'reference_refno', 'ref_table', 'ref_id', 'review','state',  'created_by', 'updated_by'];

 
    public function tracking_to()
    {
        return $this->belongsTo(Tracking::class,'tracking_id');
    }

    public function certificate_export_to()
    {
        if($this->certificate_type == 1){
            return $this->belongsTo(CertiCBExport::class,'ref_id','id');
          }else if($this->certificate_type == 2){
            return $this->belongsTo(CertiIBExport::class,'ref_id','id');
          }else{
            return $this->belongsTo(CertificateExport::class,'ref_id','id');
          }
    }
 

   // หลักฐานการชำระ จนท.
    public function FileAttachEvidenceTo()
    {
        return $this->belongsTo(AttachFile::class, 'id','ref_id')
                        ->select('id','new_filename','filename','url')
                        ->where('ref_table',$this->table)
                        ->where('section','evidence')
                        ->orderby('id','desc');
    }
    // หลักฐานการชำระ ผปก.
    public function FileAttachFilesTo()
    {
 
        return $this->belongsTo(AttachFile::class, 'id','ref_id')
                        ->select('id','new_filename','filename','url')
                        ->where('ref_table',$this->table)
                        ->where('section','attach')
                        ->orderby('id','desc');
    }
}
