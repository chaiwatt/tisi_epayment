@if(!is_null($history->details_two)) 
@php 
$details_two = json_decode($history->details_two);
@endphp

@if (!is_null($details_two) && count($details_two) > 0)
<div class="row">
<div class="col-sm-12 m-t-15" >
   <table class="table color-bordered-table primary-bordered-table">
       <thead>
       <tr>
          <th class="text-center bg-info  text-white" width="2%">ลำดับ</th>
          <th class="text-center bg-info  text-white" width="15%">รายงานที่</th>
          <th class="text-center bg-info  text-white" width="15%">ผลการประเมินที่พบ</th>
          <th class="text-center bg-info  text-white" width="15%">มอก. 17025 : ข้อ</th>
          <th class="text-center bg-info  text-white" width="10%">ประเภท</th>
          <th class="text-center bg-info  text-white" width="33%">แนวทางการแก้ไข</th>
          <th class="text-center bg-info  text-white" width="20%" >หลักฐาน</th>
       </tr>
       </thead>
       <tbody >

         @foreach($details_two as $key1 => $item1)   
             @php 
               $type =   ['1'=>'ข้อบกพร่อง','2'=>'ข้อสังเกต'];
           @endphp
             <tr>
                <td class="text-center">{{ $key1+1 }}</td>
                <td>
                    {{ $item1->report ?? null }}
                </td>
                <td>
                    {{ $item1->remark ?? null }}
                </td>
                <td>
                    {{ $item1->no ?? null }}
                </td>
                <td>
                    {{  array_key_exists($item1->type,$type) ? $type[$item1->type] : '-' }}  
                </td>
              
                <td>
                    {{ @$item1->details ?? null }}
                    <br>
                    @if($item1->status == 1) 
                      <label for="app_name"> <span> <i class="fa fa-check-square" style="font-size:20px;color:rgb(0, 255, 42)"></i></span> ผ่าน </label> 
                    @elseif(!is_null($item1->comment)) 
                    <label for="app_name"><span>  <i class="fa  fa-close" style="font-size:20px;color:rgb(255, 0, 0)"></i> {{  'ไม่ผ่าน:'.$item1->comment ?? null   }}</span> </label> 
                   @endif
                </td>
                <td>

                         @if($item1->status == 1) 
                                     @if($item1->file_status == 1)
                                              <span> <i class="fa fa-check-square" style="font-size:20px;color:rgb(0, 255, 42)"></i> ผ่าน</span>  
                                     @elseif(isset($item1->file_comment))
                                            @if(!is_null($item1->file_comment))
                                              <span> <i class="fa  fa-close" style="font-size:20px;color:rgb(255, 0, 0)"></i> ไม่ผ่าน </span> 
                                              {!!   " : ".$item1->file_comment ?? null  !!}
                                            @endif
                                    @endif
                                <label for="app_name">
                                    <span>
                                        @if(!empty($item1->attachs))
                                         @php 
                                                  $attachs = $item1->attachs;
                                        @endphp
                                                  <a href="{{url('funtions/get-view/'.$attachs->url.'/'.( !empty($attachs->filename) ? $attachs->filename : basename($attachs->new_filename) ))}}" target="_blank">
                                                            {!! HP::FileExtension($attachs->filename)  ?? '' !!}
                                                  </a>  
                                        @endif
                                    </span> 
                                </label> 
                        @endif
                </td>
               </tr> 
           @endforeach
        
       </tbody>
   </table>
</div>
</div>
@endif
@endif 

@if(!is_null($history->details_three))
@php 
$details_three = json_decode($history->details_three);
 
@endphp 
@if(!is_null($details_three))

<div class="row">
<div class="col-md-4 text-right">
<p class="text-nowrap">รายงานการตรวจประเมิน :</p>
</div>
<div class="col-md-8 text-left">
    <p> 
        <a href="{{url('funtions/get-view/'.$details_three->url.'/'.( !empty($details_three->filename) ? $details_three->filename : basename($details_three->new_filename) ))}}" target="_blank">
            {!! HP::FileExtension($details_three->filename)  ?? '' !!}
        </a>  
    </p>
</div>
</div>

@endif
@endif

@if(!is_null($history->file))
@php 
$files = json_decode($history->file);
 
@endphp 
@if(!empty($files) && count($files) > 0)

<div class="row">
<div class="col-md-4 text-right">
<p class="text-nowrap">ไฟล์แนบ :</p>
</div>
<div class="col-md-8 text-left">
  @foreach($files as $file)          
    <p> 
        <a href="{{url('funtions/get-view/'.$file->url.'/'.( !empty($file->filename) ? $file->filename : basename($file->new_filename) ))}}" target="_blank">
            {!! HP::FileExtension($file->filename)  ?? '' !!}
        </a>  
    </p>
   @endforeach
</div>
</div>

@endif
@endif



@if(!is_null($history->created_at)) 
<div class="row">
<div class="col-md-4 text-right">
    <p >วันที่เจ้าหน้าที่บันทึก :</p>
</div>
<div class="col-md-8 text-left">
    {{ @HP::DateThai($history->created_at) ?? '-' }}
</div>
</div>
@endif

@if(!is_null($history->date)) 
<div class="row">
<div class="col-md-4 text-right">
    <p >วันที่ผู้ประกอบการบันทึก :</p>
</div>
<div class="col-md-8 text-left">
    {{ @HP::DateThai($history->date) ?? '-' }}
</div>
</div>
@endif
