@push('css')
    <link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/components/bootstrap-datepicker-thai/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
@endpush

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{-- <div class="col-md-6">
                <label class="col-md-4 text-right"><span class="text-danger">*</span> เลขคำขอ : </label>
                <div class="col-md-8">
                    {!! Form::hidden('group_id',  $notice->assessment_group->id ??  null,  ['class' => 'form-control', 'id'=>'appGroupId','required'=>true])!!}
                    @if(!isset($notice->applicant->app_no) && isset($app_no))
                    {!! Form::select('auditor_id',
                          $app_no,
                          null,
                        ['class' => 'form-control',
                        'ref'=>'auditor_id',
                        'id'=>'auditor_id',
                        'placeholder'=>'-เลือกคำขอ-'])
                      !!}
                    @else 
                      <input type="text" class="form-control"  name="app_no"   value="{{ $notice->applicant->app_no ?? null }}"   readonly >  
                    @endif
                   
                </div>
            </div> --}}
            <div class="col-md-6">
                <label class="col-md-4 text-right"><span class="text-danger">*</span> เลขคำขอ : </label>
                <div class="col-md-8">
                    <!-- Hidden Input -->
                    <input type="hidden" name="group_id" id="appGroupId" class="form-control" value="{{ $notice->assessment_group->id ?? null }}" required>    
                    @if (!isset($notice->applicant->app_no) && isset($app_no))
                        <select name="auditor_id"  class="form-control" id="auditor_id" ref="auditor_id" required>
                            <option value="" disabled selected>-เลือกคำขอ-</option>
                            @foreach ($app_no as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" class="form-control" name="app_no" value="{{ $notice->applicant->app_no ?? null }}" readonly>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <label class="col-md-4 text-right">ชื่อผู้ยื่นคำขอ : </label>
                <div class="col-md-8">
                    {!! Form::text('department',   $notice->applicant->name ??  null,  ['class' => 'form-control', 'id'=>'appDepart','disabled'=>true])!!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="col-md-4 text-right">ชื่อห้องปฏิบัติการ : </label>
                <div class="col-md-8">
                    {!! Form::text('lab_name',   $notice->applicant->lab_name ??  null,  ['class' => 'form-control', 'id'=>'appLabName','disabled'=>true])!!}
                </div>
            </div>
            {{-- @if(isset($notice))  --}}
            <div class="col-md-6">
                <label class="col-md-4 text-right"><span class="text-danger">*</span> วันที่บันทึก : </label>
                <div class="col-md-8">
                     <div class="input-group">
                        {!! Form::text('savedate', !empty($notice->assessment_date) ? HP::revertDate($notice->assessment_date->format("Y-m-d"),true) :  null,  ['class' => 'form-control mydatepicker', 'id'=>'SaveDate','required'=>true,'placeholder'=>'dd/mm/yyyy'])!!}
                        <span class="input-group-addon"><i class="icon-calender"></i></span>
                    </div>
                </div>
            </div>
            {{-- @endif --}}

        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="col-md-5 text-right"><span class="text-danger">*</span> รายงานข้อบกพร่อง : </label>
                <div class="col-md-7">
                    <div class="row">
                        <label class="col-md-6">
                            {!! Form::radio('report_status', '1', isset($notice)  && !empty($notice->report_status ==1) ? true:false , ['class'=>'check', 'data-radio'=>'iradio_square-green','required'=>'required']) !!}  มี
                        </label>
                        <label class="col-md-6">
                            {!! Form::radio('report_status', '2', isset($notice) && !empty($notice->report_status ==1) ? false: true, ['class'=>'check', 'data-radio'=>'iradio_square-red','required'=>'required']) !!} ไม่มี
                        </label>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <label class="col-md-4 text-right"><span class="text-danger">*</span>รายงานการตรวจประเมิน : </label>
                <div class="col-md-8">
                    @if(isset($notice)  && !is_null($notice->file)) 
                        <a href="{{url('certify/check/file_client/'.$notice->file.'/'.( !empty($notice->file_client_name) ? $notice->file_client_name : 'null' ))}}" 
                            title=" {{ !empty($notice->file_client_name) ? $notice->file_client_name : basename($notice->file)}}"   target="_blank">
                            {!! HP::FileExtension($notice->file)  ?? '' !!}
                        </a>
                    @else 
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput" >
                        <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">เลือกไฟล์</span>
                        <span class="fileinput-exists">เปลี่ยน</span>
                            <input type="file" name="file" required class="check_max_size_file">
                            </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
                        </div>
                    @endif
                </div>
            </div> --}}
            @if(isset($notice)) 
            <div class="col-md-6">
                <label class="col-md-4 text-right"><span class="text-danger">*</span>รายงานการตรวจประเมิน : </label>
                <div class="col-md-8">
                    @if(isset($notice)  && !is_null($notice->file)) 
                        <a href="{{url('certify/check/file_client/'.$notice->file.'/'.( !empty($notice->file_client_name) ? $notice->file_client_name : 'null' ))}}" 
                            title=" {{ !empty($notice->file_client_name) ? $notice->file_client_name : basename($notice->file)}}"   target="_blank">
                            {!! HP::FileExtension($notice->file)  ?? '' !!}
                        </a>
                    {{-- @else 
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput" >
                        <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">เลือกไฟล์</span>
                        <span class="fileinput-exists">เปลี่ยน</span>
                            <input type="file" name="file" required class="check_max_size_file">
                            </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
                        </div> --}}
                    @endif
                </div>
            </div>
            @endif
        </div>
        
        {{-- <div class="form-group" id="div_file_scope">
            <div class="col-md-12">
                <div class="white-box" style="border: 2px solid #e5ebec;">
                <legend><h3>ขอบข่ายที่ขอรับการรับรอง (Scope)</h3></legend>   
                      
                   <div class="row">
                       <div class="col-md-12 ">
                           <div id="other_attach-box">
                               <div class="form-group other_attach_scope">
                                   <div class="col-md-4 text-right">
                                       <label class="attach_remove"><span class="text-danger">*</span> Scope  </label>
                                   </div>
                                   <div class="col-md-6">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput" >
                                            <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">เลือกไฟล์</span>
                                            <span class="fileinput-exists">เปลี่ยน</span>
                                                <input type="file" name="file_scope[]"  class=" check_max_size_file">
                                                </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
                                            </div>
                                   </div>
                                   <div class="col-md-2 text-left">
                                       <button type="button" class="btn btn-sm btn-success attach_remove" id="attach_add_scope">
                                           <i class="icon-plus"></i>&nbsp;เพิ่ม
                                       </button>
                                       <div class="button_remove_scope"></div>
                                   </div> 
                                </div>
                              </div>
                        </div>
                   </div>

               </div>
           </div>
        </div> --}}

    </div>
</div>

<div class="clearfix"></div>
<div class="row status_report_status">
    <div class="col-md-12 text-right" v-if="isTable">
        <button type="button" class="btn btn-success btn-sm" id="plus-row"><i class="icon-plus"></i> เพิ่ม</button>
    </div>
    <div class="col-sm-12 m-t-15 " v-if="isTable" id="box-required">
        <table class="table color-bordered-table primary-bordered-table">
            <thead>
            <tr>
                <th class="text-center" width="1%">ลำดับ</th>
                <th class="text-center" width="10%">รายงานที่</th>
                <th class="text-center" width="10%">ข้อบกพร่อง/ข้อสังเกต</th>
                <th class="text-center" width="10%">มอก. 17025 : ข้อ</th>
                <th class="text-center" width="10%">ประเภท</th>
                {{-- <th class="text-center" width="10%">ผู้พบ</th> --}}
                <th class="text-center" width="5%"> <i class="fa fa-pencil-square-o"></i></th>
            </tr>
            </thead>
            <tbody id="table-body">
                @foreach($NoticeItem as $key => $item)
                <tr>
                    <td class="text-center">
                        1
                    </td>
                    <td>
                        {!! Form::hidden('id[]',!empty($item->id)?$item->id:null, ['class' => 'form-control '])  !!}
                        {!! Form::text('report[]', $item->report ?? null,  ['class' => 'form-control input_required','required'=>true])!!}
                    </td>
                    <td>
                        {!! Form::text('notice[]', $item->remark ?? null,  ['class' => 'form-control input_required','required'=>true])!!}
                    </td>
                    <td>
                        {!! Form::text('nok[]',  $item->no ?? null,  ['class' => 'form-control input_required','required'=>true])!!}
                    </td>
                    <td>
                        {!! Form::select('type[]',
                          ['1'=>'ข้อบกพร่อง','2'=>'ข้อสังเกต'],
                            $item->type ?? null,
                            ['class' => 'form-control type input_required  select2',
                            'required'=>true,
                            'placeholder'=>'-เลือกประเภท-'])
                        !!}
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row" ><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-10 ">
            <div id="other_attach">
                <div class="form-group other_attach_item">
                    <div class="col-md-2 text-light">
                        <label for="#" class="label_other_attach text-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไฟล์แนบ : </label>

                    </div>
                    <div class="col-md-6">
                        <div class="fileinput fileinput-new input-group " data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">เลือกไฟล์</span>
                                <span class="fileinput-exists">เปลี่ยน</span> 
                                {{-- {!! Form::file('attachs[]', null) !!} --}}
                                <input type="file" name="attachs[]" class="check_max_size_file">
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
                        </div>
                        {!! $errors->first('attachs', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-2 text-left">
                        <button type="button" class="btn btn-sm btn-success attach-add" id="attach-add">
                            <i class="icon-plus"></i>&nbsp;เพิ่ม
                        </button>
                        <div class="button_remove"></div>
                    </div>
                </div>
            </div>
            @if(isset($notice)  && !is_null($notice->attachs)) 
                @php 
                $attachs = json_decode($notice->attachs);
                @endphp
                    @foreach($attachs as  $key => $item)
                        <div class="row">
                            <div class="col-md-2 text-light"></div>
                            <div class="col-md-10">
                               <a href="{{url('certify/check/file_client/'.$item->attachs.'/'.( !empty($item->attachs_client_name) ? $item->attachs_client_name : 'null' ))}}" 
                                      title=" {{ !empty($item->attachs_client_name) ? $item->attachs_client_name :  basename($item->attachs)}}"  target="_blank">
                                    {!! HP::FileExtension($item->attachs)  ?? '' !!}
                                    {!!  !empty($item->attachs_client_name) ? $item->attachs_client_name :  @basename($item->attachs) ?? '' !!}
                                </a>
                            </div>
                            
                        </div>
                    @endforeach
                </p>  
           @endif
        </div>
     </div>
</div>

@if(isset($notice)  && !in_array($notice->degree,[1,4,8]))
<div class="clearfix"></div>
   <a  href="{{ url("certify/save_assessment") }}"  class="btn btn-default btn-lg btn-block">
      <i class="fa fa-rotate-left"></i>
     <b>กลับ</b>
 </a>
@else
<div class="form-group">
    <div class="col-md-offset-4 col-md-4 m-t-15">

        <div id="degree_btn"></div>
        <button class="btn btn-primary " type="button"   onclick="submit_form('1');return false;">
            <i class="fa fa-paper-plane"></i> บันทึก
        </button>
        <a class="btn btn-default" href="{{url('/certify/save_assessment')}}"><i class="fa fa-rotate-left"></i> ยกเลิก</a>
    </div>
</div> 
@endif
@push('js')
  <script src="{{ asset('plugins/components/icheck/icheck.min.js') }}"></script>
  <script src="{{ asset('plugins/components/icheck/icheck.init.js') }}"></script>
       <!-- input calendar thai -->
       <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
       <!-- thai extension -->
       <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}"></script>
       <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
       <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
       <script>
         function  submit_form(degree){ 
                var report_status = $("input[name=report_status]:checked").val(); 
       
                var main_state =  $("input[name=main_state]:checked").val();

                    if(report_status == 2){
                        let i = 4;
                        Swal.fire({
                                title:"ยืนยันทำรายการ !",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'บันทึก',
                                cancelButtonText: 'ยกเลิก'
                                }).then((result) => {
                                    if (result.value) {
                                        $('#degree_btn').html('<input type="text" name="degree" value="'+i+'" hidden>');
                                       $('#form_assessment').submit();
                                    }
                            })
              
                    }else{
                
                        if(degree == 0){  // ฉบับร่าง
         
                            Swal.fire({
                                title:'ยืนยันทำฉบับร่างรายงานข้อบกพร่อง !',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'บันทึก',
                                cancelButtonText: 'ยกเลิก'
                                }).then((result) => {
                                    if (result.value) {
                                        $('#degree_btn').html('<input type="text" name="degree" value="' + degree + '" hidden>');
                                       $('#form_assessment').submit();
                                    }
                            })
                        }else{
                            let title = '';
                            let l = '';
                            if(main_state == 2){
                                title =  'ยืนยันปิดผลการตรวจประเมิน !';
                                l = 8;
                            }else{
                        
                                title =  'ยืนยันทำรายงานข้อบกพร่อง !';
                                l = 1;
                            }
                        
                
                            Swal.fire({
                                title:title,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'บันทึก',
                                cancelButtonText: 'ยกเลิก'
                                }).then((result) => {
                                    if (result.value) {
                                        $('#degree_btn').html('<input type="text" name="degree" value="' + l + '" hidden>');
                                          $('#form_assessment').submit();
                                    }
                            })
                        }   
                
                    } 
       }

        $(document).ready(function () {
            $('#form_assessment').parsley().on('field:validated', function() {
             var ok = $('.parsley-error').length === 0;
                       $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
             }) .on('form:submit', function() {
            // Text
               $.LoadingOverlay("show", {
                            image       : "",
                            text  : "กำลังบันทึก กรุณารอสักครู่..."
                            });
                        return true; // Don't submit form for this demo
              });
            //เพิ่มไฟล์แนบ
                check_max_size_file();
            $('#attach_add_scope').click(function(event) {
                $('.other_attach_scope:first').clone().appendTo('#other_attach-box');
                $('.other_attach_scope:last').find('input').val('');
                $('.other_attach_scope:last').find('a.fileinput-exists').click();
                $('.other_attach_scope:last').find('a.view-attach').remove();
                $('.other_attach_scope:last').find('.attach_remove').remove();
                $('.other_attach_scope:last').find('.button_remove_scope').html('<button class="btn btn-danger btn-sm attach_remove_scope" type="button"> <i class="icon-close"></i>  </button>');
                check_max_size_file();
            });
    
            //ลบไฟล์แนบ
            $('body').on('click', '.attach_remove_scope', function(event) {
                $(this).parent().parent().parent().remove();
            });
    
 
        });
    
    </script>
       <script>
        $(document).ready(function () {

        //เพิ่มไฟล์แนบ
        $('#attach-add').click(function(event) {
            $('.other_attach_item:first').clone().appendTo('#other_attach');
            $('.other_attach_item:last').find('input').val('');
            $('.other_attach_item:last').find('a.fileinput-exists').click();
            $('.other_attach_item:last').find('a.view-attach').remove();
            $('.other_attach_item:last').find('.label_other_attach').remove();
            $('.other_attach_item:last').find('button.attach-add').remove();
            $('.other_attach_item:last').find('.button_remove').html('<button class="btn btn-danger btn-sm attach-remove" type="button"> <i class="icon-close"></i>  </button>');
            check_max_size_file();
        });

        //ลบไฟล์แนบ
        $('body').on('click', '.attach-remove', function(event) {
            $(this).parent().parent().parent().remove();
        });



            //ปฎิทิน
            $('.mydatepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                language:'th-th',
                format: 'dd/mm/yyyy',
                orientation: 'bottom'
            });
            $('#auditor_id').change(function(){

                if($(this).val()!=""){
                    $.ajax({
                        url:'{{ route('save_assessment.api.get.app') }}/' + $(this).val()
                    }).done(function( object ) {
                        if (object.message === true) {
                            const app = object.app;
                            var appDepart = app ? app.name : '';
                            var appLabName = app ? app.lab_name : '';
                            $('#appDepart').val(appDepart);
                            $('#appLabName').val(appLabName);

                            $('#SaveDate').val(object.created_at);
                            $('#appGroupId').val(object.group_id);

                        }else{
                  
                             $('#appDepart').val('');
                             $('#appLabName').val('');
                             $('#auditor_id').val('').select2();
                             $('#SaveDate').val('');
                             $('#appGroupId').val('');

                        }


                    });
                }else{
                            $('#appDepart').val('');
                             $('#appLabName').val('');
                             $('#auditor_id').val('').select2();
                             $('#SaveDate').val('');
                             $('#appGroupId').val('');
                }

            });

        //  รายงานข้อบกพร่อง
        $("input[name=report_status]").on("ifChanged",function(){
                status_report_status();
             });
                status_report_status();
                function status_report_status(){
                var row = $("input[name=report_status]:checked").val(); 
                    if(row == "1"){
                        $('.status_report_status').show(200); 
                        $('#box-required').find('.input_required').prop('required', true);
                        $('#div_file_scope').hide(400); 
                        $('.file_scope_required').prop('required', false);
                    } else{
                        $('.status_report_status').hide(400);
                        $('#box-required').find('.input_required').prop('required', false);
                        $('#div_file_scope').show(200); 
                        $('.file_scope_required').prop('required', true);
                    }
                }
         });

    </script>
    <script>
        jQuery(document).ready(function() {
            check_max_size_file();
            //เพิ่มแถว
            $('#plus-row').click(function(event) {
              //Clone
              $('#table-body').children('tr:first()').clone().appendTo('#table-body');
              //Clear value
                var row = $('#table-body').children('tr:last()');



                row.find('select.select2').val('');
                row.find('select.select2').prev().remove();
                row.find('select.select2').removeAttr('style');
                row.find('select.select2').select2();
                row.find('input[type="text"],textarea').val('');
                row.find('.file_attachs').html('');
                row.find('input[type="hidden"]').val('');
                var html =[];
                    html += '<div class="fileinput fileinput-new input-group" data-provides="fileinput" >';
                    html += '<div class="form-control" data-trigger="fileinput">';
                    html += '<i class="glyphicon glyphicon-file fileinput-exists"></i>';
                    html += '<span class="fileinput-filename"></span>';
                    html += '</div>';
                    html += '<span class="input-group-addon btn btn-default btn-file">';
                    html += '<span class="fileinput-new">เลือกไฟล์</span>';
                    html += '<span class="fileinput-exists">เปลี่ยน</span>';
                    html += '<input type="file" name="attachs[]" class="check_max_size_file">';
                    html += '</span>';
                    html += '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>';
                    html += '</div>';
                row.find(".file_attachs").append(html);
              //เลขรัน
              ResetTableNumber();
              check_max_size_file();
            //   ChangeSelectTypeFile();
            });
            //ลบแถว
            $('body').on('click', '.remove-row', function(){
              $(this).parent().parent().remove();
              ResetTableNumber();
            });
            ResetTableNumber();
            // ChangeSelectTypeFile();
        });
        //รีเซตเลขลำดับ
        function ResetTableNumber(){
          var rows = $('#table-body').children(); //แถวทั้งหมด
          (rows.length==1)?$('.remove-row').hide():$('.remove-row').show();
          rows.each(function(index, el) {
            //เลขรัน
            $(el).children().first().html(index+1);
            //เลข index
            $(el).children().find('input[type="file"]').prop('name', 'attachs['+index+']');
          });
        }

        function ChangeSelectTypeFile(){
             $('select.type').change(function(){
                var file =   $(this).parent().parent().find(".file_attachs");
                    file.html('');
                if($(this).val() != ''){
                    var html =[];
                    html += '<div class="fileinput fileinput-new input-group" data-provides="fileinput" >';
                    html += '<div class="form-control" data-trigger="fileinput">';
                    html += '<i class="glyphicon glyphicon-file fileinput-exists"></i>';
                    html += '<span class="fileinput-filename"></span>';
                    html += '</div>';
                    html += '<span class="input-group-addon btn btn-default btn-file">';
                    html += '<span class="fileinput-new">เลือกไฟล์</span>';
                    html += '<span class="fileinput-exists">เปลี่ยน</span>';
                    html += '<input type="file" name="attachs[]" class="check_max_size_file">';
                    html += '</span>';
                    html += '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>';
                    html += '</div>';
                    file.append(html);
                    check_max_size_file();
                }else{
                    file.html('');
                }
                ResetTableNumber();
            });
        }
</script>
@endpush
