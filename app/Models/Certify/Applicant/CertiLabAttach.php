<?php

namespace App\Models\Certify\Applicant;

use Illuminate\Database\Eloquent\Model;

class CertiLabAttach extends Model
{
    //
    protected $table = "app_certi_lab_attaches";


    public function attachmore()
    {
        $this->hasMany(CertiLabAttachMore::class,'app_certi_lab_attach_id');
    }

    public function certi_lab()
    {
        $this->belongsTo(CertiLab::class ,'app_certi_lab_id' );
    }
}
