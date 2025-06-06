{{-- work on BoardAuditorController --}}
@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">เพิ่มคณะผู้ตรวจประเมิน</h3>
                    @can('view-'.str_slug('board-auditor'))
                        <a class="btn btn-success pull-right" href="{{ app('url')->previous()  }}">
                            <i class="icon-arrow-left-circle"></i> กลับ
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    

                        @push('css')
                            <link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
                            <link href="{{asset('plugins/components/bootstrap-datepicker-thai/css/datepicker.css')}}" rel="stylesheet" type="text/css" />

                            <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
                            <style type="text/css">
                                .img {
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    padding: 5px;
                                }
                            </style>
                        @endpush
                        {!! Form::open(['url' => '/certify/setting-team-ib/store', 'class' => 'form-horizontal', 'files' => true,'id'=>'form_auditor']) !!}
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="auditor_name" class="col-md-2 col-md-offset-1 control-label">
                                            <span class="text-danger">*</span> ชื่อคณะ
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" name="auditor_name" id="auditor_name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                                        {!! Form::label('state', 'สถานะ:', ['class' => 'col-md-2 col-md-offset-1 control-label']) !!}
                                        <div class="col-md-7">
                                            <label>{!! Form::radio('state', '1', true, ['class'=>'check', 'data-radio'=>'iradio_square-green']) !!} เปิด</label>
                                            <label>{!! Form::radio('state', '0', false, ['class'=>'check', 'data-radio'=>'iradio_square-red']) !!} ปิด</label>
                    
                                            {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
    
                                

                                <div class="col-md-12 repeater">
                                    <button type="button" class="btn btn-success btn-sm pull-right clearfix " id="plus-row">
                                        <i class="icon-plus" aria-hidden="true"></i>
                                        เพิ่ม
                                    </button>
                                    <div class="clearfix"></div>
                                    <br/>
                                <table class="table color-bordered-table primary-bordered-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">สถานะผู้ตรวจประเมิน</th>
                                        <th class="text-center">ชื่อผู้ตรวจประเมิน</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">หน่วยงาน</th>
                                        <th class="text-center"> ลบรายการ</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach($auditors_status as $key => $item)    
                                    <tr class="repeater-item">
                                        <td class="text-center text-top">
                                            <div class="form-group {{ $errors->has('taxid') ? 'has-error' : ''}}">
                                                <div class="col-md-9">
                                                    {!! Form::select('list[status][]',    
                                                    App\Models\Bcertify\StatusAuditor::pluck('title', 'id'),
                                                    $item->status ??  null,
                                                    ['class' => 'form-control item status select2', 
                                                    'placeholder'=>'-เลือกสถานะผู้ตรวจประเมิน-',
                                                    'data-name'=>'status', 
                                                    'required'=>true]); !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-right text-top ">
                                            <div class="td-users">
                                                @if(count($item->CertiIBAuditorsLists) > 0)
                                                    @foreach($item->CertiIBAuditorsLists as $key1 => $item1) 
                                                    {!! Form::text('filter_search',
                                                        $item1->temp_users ?? null, 
                                                        ['class' => 'form-control item', 
                                                        'readonly' => true])
                                                    !!}
                                                    <input type="hidden" name="list[temp_users][{{$item->status}}][]"  value="{{$item1->temp_users}}">
                                                    <input type="hidden" name="list[user_id][{{$item->status}}][]"  value="{{$item1->user_id}}">
                                                    <input type="hidden" name="list[temp_departments][{{$item->status}}][]" value="{{$item1->temp_departments}}">
                                                    @endforeach
                                                @else 
                                                {!! Form::text('filter_search', null, ['class' => 'form-control item', 'placeholder'=>'','data-name'=>'filter_search','required' => true]); !!}
                                                @endif
                                            </div>
                                            <div class="div-users"></div>
                                        </td>
                                        {{-- จะแสดงข้อมูลใน popup ก็ต้องเมื่อเลือก "สถานะผู้ทบทวนผลการประเมิน" --}}
                                        <td class="text-top">
                                            <button type="button" class="btn btn-primary repeater-modal-open exampleModal" data-toggle="modal" data-target="#exampleModal"  {{ !is_null($item->status) ? '' : 'disabled' }} 
                                                    data-whatever="@mdo"> select
                                            </button>
                                            <!--   popup ข้อมูลผู้ตรวจการประเมิน   -->
                                            <div class="modal fade repeater-modal exampleModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title" id="exampleModalLabel1">ผู้ตรวจประเมิน</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="white-box">
                                                                <div class="row">
                                                                    <div class="form-group {{ $errors->has('myInput') ? 'has-error' : ''}}">
                                                                        {!! HTML::decode(Form::label('myInput', 'ค้นหา', ['class' => 'col-md-2 control-label'])) !!}
                                                                        <div class="col-md-7">
                                                                            <input class="form-control myInput"  type="text" placeholder="ชื่อผู้ตรวจประเมิน,หน่วยงาน,ตำแหน่ง,สาขา">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-group ">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered color-table primary-table" id="myTable" width="100%">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th  class="text-center" width="2%">#</th>
                                                                                    <th  class="text-center" width="2%">
                                                                                        <input type="checkbox" class="select-all">
                                                                                    </th>
                                                                                    <th class="text-center" width="10%">ชื่อผู้ตรวจประเมิน</th>
                                                                                    <th class="text-center" width="10%">หน่วยงาน</th>
                                                                                    <th class="text-center" width="10%">ตำแหน่ง</th>
                                                                                    <th class="text-center" width="10%">สาขา</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="tbody-auditor">
                                                                                    @if(count($item->AuditorExpertiseTitle) > 0)
                                                                                        @foreach($item->AuditorExpertiseTitle as $key2 => $item2) 
                                                                                        <tr>
                                                                                            <td> {{ $key2 +1 }}</td>
                                                                                            <td  class="text-center"> 
                                                                                            <input type="checkbox"
                                                                                                value="{{$item2->id}}"  
                                                                                                data-value="{{$item2->NameTh}}"  
                                                                                                data-department="{{$item2->department}}" 

                                                                                                data-status="{{$item->status}}"
                                                                                            >
                                                                                            </td>
                                                                                            <td> {{ $item2->NameTh}}</td>
                                                                                            <td> {{ $item2->department}}</td>
                                                                                            <td> {{ $item2->position}}</td>
                                                                                            <td> {{ $item2->branchable}}</td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-8">
                                                                <div class="pull-right">
                                                                    {!! Form::button('<i class="icon-check"></i> เลือก', ['type' => 'button', 'class' => 'btn btn-primary btn-user-select']) !!}
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                                                                        {!! __('ยกเลิก') !!}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-top text-top  ">
                                            <div class="td-departments">
                                            @if(count($item->CertiIBAuditorsLists) > 0)
                                                @foreach($item->CertiIBAuditorsLists as $key1 => $item1) 
                                                    <input type="text" class="form-control item" readonly value="{{ $item1->temp_departments }}">
                                                @endforeach
                                            @else 
                                                {!! Form::text('department', 
                                                    null,
                                                    ('' == 'required') ?
                                                    ['class' => 'form-control item', 'required' => 'required'] :
                                                    ['class' => 'form-control item','readonly'=>'readonly',
                                                    'data-name'=>'department']) 
                                                !!}
                                            @endif
                                            </div>
                                            <div class="div-departments"></div>
                                        </td>
                                        <td align="center" class="text-top">
                                            <button type="button" class="btn btn-danger btn-xs repeater-remove">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        

                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">

                                    <input type="hidden" name="previousUrl" id="previousUrl" value="{{ app('url')->previous() }}">
                                    <button class="btn btn-primary" type="submit" id="form-save"  onclick="submit_form();return false;">
                                        <i class="fa fa-paper-plane"></i> บันทึก
                                    </button>
                            
                                    <a class="btn btn-default" href="{{ app('url')->previous()  }}">
                                        <i class="fa fa-rotate-left"></i> ยกเลิก
                                    </a>
                            
                                </div>
                            </div>

                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>



    @push('js')
    <script src="{{ asset('plugins/components/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/components/icheck/icheck.init.js') }}"></script>
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
  <!-- input calendar thai -->
  <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
  <!-- thai extension -->
  <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}"></script>
  <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
  <script src="{{asset('plugins/components/sweet-alert2/sweetalert2.all.min.js')}}"></script>
  <script type="text/javascript">
 
          $(document).ready(function () {

            $('#form_auditor').parsley().on('field:validated', function() {
                                var ok = $('.parsley-error').length === 0;
                                $('.bs-callout-info').toggleClass('hidden', !ok);
                                $('.bs-callout-warning').toggleClass('hidden', ok);
                        })  .on('form:submit', function() {
                                // Text
                          $.LoadingOverlay("show", {
                                image       : "",
                                text  : "กำลังบันทึก กรุณารอสักครู่..."
                           });
                          return true; 
                    });


            @if(!empty($auditor) && ($auditor->vehicle == 1 || $auditor->status_cancel == 1))
                $('#box-readonly').find('input').prop('disabled', true);
                $('#box-readonly').find('select').prop('disabled', true);
                $('#box-readonly').find('.div_hide').hide();
            @endif
  
              ResetTableNumber1();
              AuditorStatus();
            //   DataListDisabled();
              IsInputNumber();
              IsNumber();
          //เพิ่มแถว
          $('#plus-row').click(function(event) {
                    //  var data = $('.status').find('option[value!=""]:not(:selected):not(:disabled)').length;
                    //   if(data == 0){
                    //       Swal.fire('หมดรายการรายสถานะผู้ตรวจประเมิน !!')
                    //       return false;
                    //   }
                    //Clone
                    $('#table-body').children('tr:first()').clone().appendTo('#table-body');
                    //Clear value
                    var row = $('#table-body').children('tr:last()');
                    row.find('.myInput').val('');
                    row.find('select.select2').val('');
                    row.find('select.select2').prev().remove();
                    row.find('select.select2').removeAttr('style');
                    row.find('select.select2').select2();
                    row.find('.exampleModal').prop('disabled',true);
          
                    row.find('.td-users').remove();
                    row.find('.div-users').html('<input type="text" name="filter_search" class="form-control item">');
          
                    row.find('.td-departments').remove();
                    row.find('.div-departments').html('<input type="text" name="filter_search" class="form-control item" readonly>');
                    
                    row.find('.tbody-auditor').html('');
                    row.find('input[type=checkbox]').prop('checked',false);
          
                    ResetTableNumber1(); 
                    AuditorStatus();
                    // DataListDisabled();
        
                    row.find('.btn-user-select').on('click', function () {
                              modalHiding($(this).closest('.modal'));
                    });
                    row.find('.select-all').on('change', function () {
                              checkedAll($(this));
                    });

                     //Clone
                   $('#table_body').children('tr:first()').clone().appendTo('#table_body');
                    //Clear value
                    var row1 = $('#table_body').children('tr:last()');
                    row1.find('input[type="text"]').val('');
                    IsInputNumber();
                    ResetTableNumber();
                    IsNumber();
                    cost_rate();
                    check_max_size_file();
          
            });
             //ลบแถว
             $('body').on('click', '.repeater-remove', function(){
                var key =    $(this).parent().parent().find('select.select2').data('key');
                console.log(key);
                $('#detail'+key).parent().parent().remove();
               $(this).parent().parent().remove();
                ResetTableNumber1();
                IsInputNumber();
                ResetTableNumber();
                IsNumber();
                cost_rate();
                // DataListDisabled();
                setRepeaterIndex();
              });
              
              setRepeaterIndex();

              function ResetTableNumber1(){
                  var rows = $('#table-body').children(); //แถวทั้งหมด
                  (rows.length==1)?$('.repeater-remove').hide():$('.repeater-remove').show();
                    rows.each(function(index, el) {
                        $(el).find('button.exampleModal').attr('data-target','#exampleModal'+index);
                        $(el).find('div.exampleModal').prop('id','exampleModal'+index);
                        $(el).find('select.select2').attr('data-key', index);
                  });
             }
  

             function ResetTableNumber(){
                var rows = $('#table_body').children(); //แถวทั้งหมด
                (rows.length==1)?$('.remove-row').hide():$('.remove-row').show();
                rows.each(function(index, el) {
                    //เลขรัน
                    $(el).children().first().html(index+1);
                    $(el).find('.detail').attr('id', 'detail'+index);
                });
         }
             function AuditorStatus(){
  
                $('.status').change(function(){
                        $('.myInput').val('');
                    let  exampleModal =  $(this).parent().parent().parent().parent().find('.exampleModal');
                    let  auditor =   $(this).parent().parent().parent().parent().find('.tbody-auditor');
                    let  row =   $(this).parent().parent().parent().parent();
                         row.find('.td-users').remove();
                         row.find('.div-users').html('<input type="text" name="filter_search" class="form-control item">');
                         row.find('.td-departments').remove();
                         row.find('.div-departments').html('<input type="text" name="filter_search" class="form-control item" readonly>');
                    let html = [];
                    var expenses = $(this).data('key');
                      if($(this).val() != ''){
                   
                          let status = $(this).val();
                          auditor.html('');  
                          exampleModal.prop('disabled',false);
                       
                       
                          $.ajax({
                             url: "{!! url('certify/auditor/status/ib_and_cb') !!}" + "/" +  $(this).val()  + "/2" 
                          }).done(function( object ) { 
                 
                              if(object.expertise != '-'){
                                  $.each(object.expertise, function( index, item ) {
                                      html += '<tr>';
  
                                      html += '<td>';
                                          html +=  (index +1);
                                      html += '</td>';
                                      html += '<td class="text-center">';
                                          html +=   '<input type="checkbox" id="master"   value="'+item.id+'"   data-status="'+status+'"   data-value="'+item.NameTh+'"  data-department="'+item.department+'" >';
                                      html += '</td>';
  
                                      html += '<td>';
                                          html +=  item.NameTh;
                                      html += '</td>';
  
                                      html += '<td>';
                                          html +=  item.department;
                                      html += '</td>';
  
                                      html += '<td>';
                                          html +=  item.position;
                                      html += '</td>';
  
                                      html += '<td>';
                                          html +=  item.branchable;
                                      html += '</td>';
  
                                      html += '</tr>';
                                  });  
                                  auditor.append(html);
                              }
                              
                           });
                           filter_tbody_auditor();
                      
                                 var text =     $(this).children("option:selected").text();
                              $('#detail'+expenses).val(text);
                      }else{
                          auditor.html('');  
                          exampleModal.prop('disabled',true);
                          $('#detail'+expenses).val('');
                      }
               });    
             }
  
             $('.btn-user-select').on('click', function () {
              let auditor= $(this).parent().parent().parent().parent().find('.tbody-auditor');
                 modalHiding($(this).closest('.modal'));
              });
  
              $('.select-all').change(function () {
                  checkedAll($(this));
              });
  
              var tempCheckboxes = [];
          function modalHiding(that) {
              tempCheckboxes = [];
              let checkboxes = $(that).find('input[type=checkbox]');
              let Users = $(that).closest('.repeater-item').find('.td-users');
  
              let Departments = $(that).closest('.repeater-item').find('.td-departments');
              let tdUsers = $(that).closest('.repeater-item').find('.div-users');
              let tdDepartments = $(that).closest('.repeater-item').find('.div-departments');
                  tdUsers.children().remove();
                  tdDepartments.children().remove();
              checkboxes.each(function () {
                  if ($(this).val() !== 'on' && $(this).is(':checked')) {
                      let val = $(this).data('value');
                      let depart = $(this).data('department');
                      let user_id = $(this).val();
                      let status = $(this).data('status');
                      let input = $('<input type="hidden" class=" user_id"  name="list[user_id]['+status+'][]" value="'+user_id+'"><input type="text" class="form-control temp_users" name="list[temp_users]['+status+'][]" value="'+val+'" readonly>');
                      input.appendTo(tdUsers);
                      let inputDepart = $('<input type="text" class="form-control temp_departments" name="list[temp_departments]['+status+'][]" value="'+depart+'" readonly>');
                      inputDepart.appendTo(tdDepartments);
                      tempCheckboxes.push($(this));
  
                      Users.children().remove();
                      Departments.children().remove();
                  }
              });
              $(that).modal('hide');
              setRepeaterIndex();
          }
          function checkedAll(that) {
              let checkboxes = $(that).closest('.modal').find('.tbody-auditor').find('input[type=checkbox]');
              checkboxes.each(function() {
                  $(this).prop('checked', $(that).is(':checked'));
              });
          }
        //   function DataListDisabled(){
        //           $('.status').children('option').prop('disabled',false);
        //           $('.status').each(function(index , item){
        //               var data_list = $(item).val();
        //               $('.status').children('option[value="'+data_list+'"]:not(:selected):not([value=""])').prop('disabled',true);
        //           });
        //    }
  
                  TotalValue();
                  cost_rate();
 
              //เพิ่มวันที่ตรวจประเมิน
              $("#add_date").click(function() {
                  $('.dev_form_date:first').clone().insertAfter(".dev_form_date:last");
                  var row = $(".dev_form_date:last");
                  $('.dev_form_date:last > label').text(''); 
                  row.find('input.date').val('');
                  row.find('button.add_date').remove();
                  row.find('div.add_button_delete').html('<button type="button" class="btn btn-danger btn-sm pull-right date_remove"><i class="fa fa-close" aria-hidden="true"></i> ลบ </button>');
                 //ช่วงวันที่
                  $('.date-range').datepicker({
                  toggleActive: true, 
                  language:'th-th',
                  format: 'dd/mm/yyyy',
                  });
              });
              //ช่วงวันที่
             $('.date-range').datepicker({
                toggleActive: true,
                language:'th-th',
                format: 'dd/mm/yyyy',
              });
              //ลบตำแหน่ง
              $('body').on('click', '.date_remove', function() {
                      $(this).parent().parent().parent().remove();
              });
  
   
 
           //ลบตำแหน่ง
           $('body').on('click', '.date_edit_remove', function() {
                      $(this).parent().parent().remove();
              });
  
    
           function   filter_tbody_auditor() {
                 $(".myInput").on("keyup", function() {
                              var value = $(this).val().toLowerCase();
                              var row =   $(this).parent().parent().parent().parent();
                              $(row).find(".tbody-auditor tr").filter(function() {
                                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                              });
                  });   
          }
  
          function  TotalValue() {
              var rows = $('#table_body').children(); //แถวทั้งหมด
              var total_all = 0.00;
              rows.each(function(index, el) {
                  if($(el).children().find("input.number").val() != ''){
                      var number = parseFloat(RemoveCommas($(el).children().find("input.number").val()));
                      total_all  += number;
                  }
              });
              $('#costs_total').val(addCommas(total_all.toFixed(2), 2));
             }
  
             function RemoveCommas(str) {
                     var res = str.replace(/[^\d\.\-\ ]/g, '');
                     return   res;
               }
  
             function  addCommas(nStr, decimal){
                      var tmp='';
                      var zero = '0';
  
                      nStr += '';
                      x = nStr.split('.');
  
                      if((x.length-1) >= 1){//ถ้ามีทศนิยม
                          if(x[1].length > decimal){//ถ้าหากหลักของทศนิยมเกินที่กำหนดไว้ ตัดให้เหลือเท่าที่กำหนดไว้
                              x[1] = x[1].substring(0, decimal);
                          }else if(x[1].length < decimal){//ถ้าหากหลักของทศนิยมน้อยกว่าที่กำหนดไว้ เพิ่ม 0
                              x[1] = x[1] + zero.repeat(decimal-x[1].length);
                          }
                          tmp = '.'+x[1];
                      }else{//ถ้าไม่มีทศนิยม
                          if(parseInt(decimal)>0){//ถ้ามีการกำหนดให้มี ทศนิยม
                                  tmp = '.'+zero.repeat(decimal);
                              }
                      }
                      x1 = x[0];
                      var rgx = /(\d+)(\d{3})/;
                      while (rgx.test(x1)) {
                          x1 = x1.replace(rgx, '$1' + ',' + '$2');
                      }
                      return x1+tmp;
             }
  
             function IsNumber() {
                // อนุญาติให้กรอกได้เฉพาะตัวเลข 0-9 จุด และคอมม่า 
                      $(".amount_date").on("keypress",function(e){
                      var eKey = e.which || e.keyCode;
                      if((eKey<48 || eKey>57) && eKey!=46 && eKey!=44){
                      return false;
                      }
                      }); 
            }
  
   
        function setRepeaterIndex() {
            
            let n = 0;
            $('#table-body').find('tr.repeater-item').each(function (index , item){
                $(item).find('.user_id').each(function () {
                     $(this).attr('name',  "list[user_id][" + n + "][]");
                });
                $(item).find('.temp_users').each(function () {
                     $(this).attr('name',  "list[temp_users][" + n + "][]");
                });
                $(item).find('.temp_departments').each(function () {
                     $(this).attr('name',  "list[temp_departments][" + n + "][]");
                });
                n++;
            });
        }
            function IsInputNumber() {
                   // ฟังก์ชั่นสำหรับค้นและแทนที่ทั้งหมด
                   String.prototype.replaceAll = function(search, replacement) {
                      var target = this;
                      return target.replace(new RegExp(search, 'g'), replacement);
                     }; 
                      
                     var formatMoney = function(inum){ // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน 
                      var s_inum=new String(inum); 
                      var num2=s_inum.split("."); 
                      var n_inum=""; 
                      if(num2[0]!=undefined){
                     var l_inum=num2[0].length; 
                     for(i=0;i<l_inum;i++){ 
                      if(parseInt(l_inum-i)%3==0){ 
                     if(i==0){ 
                      n_inum+=s_inum.charAt(i); 
                     }else{ 
                      n_inum+=","+s_inum.charAt(i); 
                     } 
                      }else{ 
                     n_inum+=s_inum.charAt(i); 
                      } 
                     } 
                      }else{
                     n_inum=inum;
                      }
                      if(num2[1]!=undefined){ 
                     n_inum+="."+num2[1]; 
                      }
                      return n_inum; 
                     } 
                     // อนุญาติให้กรอกได้เฉพาะตัวเลข 0-9 จุด และคอมม่า 
                     $(".input_number").on("keypress",function(e){
                      var eKey = e.which || e.keyCode;
                      if((eKey<48 || eKey>57) && eKey!=46 && eKey!=44){
                     return false;
                      }
                     }); 
                     
                     // ถ้ามีการเปลี่ยนแปลง textbox ที่มี css class ชื่อ css_input1 ใดๆ 
                     $(".input_number").on("change",function(){
                      var thisVal=$(this).val(); // เก็บค่าที่เปลี่ยนแปลงไว้ในตัวแปร
                              if(thisVal != ''){
                                 if(thisVal.replace(",","")){ // ถ้ามีคอมม่า (,)
                             thisVal=thisVal.replaceAll(",",""); // แทนค่าคอมม่าเป้นค่าว่างหรือก็คือลบคอมม่า
                             thisVal = parseFloat(thisVal); // แปลงเป็นรูปแบบตัวเลข 
                              }else{ // ถ้าไม่มีคอมม่า
                             thisVal = parseFloat(thisVal); // แปลงเป็นรูปแบบตัวเลข 
                              } 
                              thisVal=thisVal.toFixed(2);// แปลงค่าที่กรอกเป้นทศนิยม 2 ตำแหน่ง
                              $(this).data("number",thisVal); // นำค่าที่จัดรูปแบบไม่มีคอมม่าเก็บใน data-number
                              $(this).val(formatMoney(thisVal));// จัดรูปแบบกลับมีคอมม่าแล้วแสดงใน textbox นั้น
                              }else{
                                  $(this).val('');
                              }
                     });
            }
  
             function cost_rate() {
               $('.cost_rate,.amount_date').keyup(function(event) {
               var row = $(this).parent().parent();
               var cost_rate =   row.find('.cost_rate').val();
               var amount_date =   row.find('.amount_date').val();
             
                  if(cost_rate != '' && amount_date != ''){
                      var sum = RemoveCommas(cost_rate) * amount_date;
                      row.find('.number').val(addCommas(sum.toFixed(2), 2));
                  }else if(cost_rate == '' || amount_date == ''){
                        row.find('.number').val('');
                  }else{
                      row.find('.number').val('');
                  }
                  TotalValue();
               });
  
  
           }
  
 
          });
  
     function  deleteFlieOtherAttach(id,$attachs){
              var html =[];
                      html += '<div class="fileinput fileinput-new input-group" data-provides="fileinput" >';
                      html += '<div class="form-control" data-trigger="fileinput">';
                      html += '<i class="glyphicon glyphicon-file fileinput-exists"></i>';
                      html += '<span class="fileinput-filename"></span>';
                      html += '</div>';
                      html += '<span class="input-group-addon btn btn-default btn-file">';
                      html += '<span class="fileinput-new">เลือกไฟล์</span>';
                      html += '<span class="fileinput-exists">เปลี่ยน</span>';
                      html += '<input type="file" name="other_attach" required class="check_max_size_file">';
                      html += '</span>';
                      html += '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>';
                      html += '</div>';
          Swal.fire({
                  icon: 'error',
                  title: 'ยื่นยันการลบไฟล์แนบ !',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'บันทึก',
                  cancelButtonText: 'ยกเลิก'
                  }).then((result) => {
                      if (result.value) {
                         $.ajax({
                              url: "{!! url('/certificate/tracking-ib/delete_file') !!}"  + "/" + id
                          }).done(function( object ) {
                              if(object == 'true'){
                                  $('#deleteFlieOtherAttach').remove();
                                 $("#AddOtherAttach").append(html);
                              }else{
                                  Swal.fire('ข้อมูลผิดพลาด');
                              }
                          });
  
                      }
                  })
                  check_max_size_file();
           }
  
           function  deleteFlieAttach(id,$attachs){
              var html =[];
                      html += '<div class="fileinput fileinput-new input-group" data-provides="fileinput" >';
                      html += '<div class="form-control" data-trigger="fileinput">';
                      html += '<i class="glyphicon glyphicon-file fileinput-exists"></i>';
                      html += '<span class="fileinput-filename"></span>';
                      html += '</div>';
                      html += '<span class="input-group-addon btn btn-default btn-file">';
                      html += '<span class="fileinput-new">เลือกไฟล์</span>';
                      html += '<span class="fileinput-exists">เปลี่ยน</span>';
                      html += '<input type="file" name="attach" required class="check_max_size_file">';
                      html += '</span>';
                      html += '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>';
                      html += '</div>';
          Swal.fire({
                  icon: 'error',
                  title: 'ยื่นยันการลบไฟล์แนบ !',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'บันทึก',
                  cancelButtonText: 'ยกเลิก'
                  }).then((result) => {
                      if (result.value) {
                         $.ajax({
                              url: "{!! url('/certificate/tracking-ib/delete_file') !!}"  + "/" + id
                          }).done(function( object ) {
                              if(object == 'true'){
                                  $('#deleteFlieAttach').remove();
                                 $("#AddAttach").append(html);
                              }else{
                                  Swal.fire('ข้อมูลผิดพลาด');
                              }
                          });
  
                      }
                  })
                  check_max_size_file();
           }
      </script>
 
    @endpush
    





@endsection
