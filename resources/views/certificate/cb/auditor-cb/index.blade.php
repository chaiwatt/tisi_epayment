@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/components/jquery-datatables-editable/datatables.css')}}" />
<link href="{{asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/components/bootstrap-datepicker-thai/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
<style>
.pointer {cursor: pointer;}
</style>
@endpush
 


@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">แต่งตั้งคณะผู้ตรวจประเมิน (CB) </h3>

                    <div class="pull-right">

                        {{-- @can('add-'.str_slug('auditorcb'))
                            <a class="btn btn-success btn-sm waves-effect waves-light" href="{{ url('/certificate/auditor-cb/create') }}">
                            <span class="btn-label"><i class="fa fa-plus"></i></span><b>เพิ่ม</b>
                            </a>
                       @endcan --}}
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <div class="row ">
                      <div class="col-md-6 form-group">
                        <div class=" {{ $errors->has('filter_search') ? 'has-error' : ''}}">
                            {!! Form::label('filter_search', 'คำค้น'.' :', ['class' => 'col-md-3 control-label text-right ']) !!}
                            <div class="col-md-9">
                                {!! Form::text('filter_search', null,  ['id' => 'filter_search','class' => 'form-control']) !!}
                            </div>
                         </div>
                      </div><!-- /.col-md-6 -->
                       <div class="col-md-4">
                              {!! Form::select('filter_status_id',
                                 ['-1'=>'ขอความเห็นการแต่งตั้งคณะผู้ตรวจประเมิน','1'=>'เห็นชอบการแต่งตั้งคณะผู้ตรวจประเมิน','2'=>'ไม่เห็นชอบการแต่งตั้งคณะผู้ตรวจประเมิน'], 
                                null, 
                                ['class' => 'form-control', 
                                'id'=>'filter_status_id',
                                'placeholder' => '- เลือกสถานะ -']); !!}
                      </div><!-- /.col-md-2 -->
                      <div class="col-md-2">
                          <div class="  pull-left">
                            <button type="button" class="btn btn-info waves-effect waves-light" id="button_search"  style="margin-bottom: -1px;">ค้นหา</button>
                        </div>
                        <div class="  pull-left m-l-15">
                            <button type="button" class="btn btn-warning waves-effect waves-light" id="filter_clear">
                                ล้าง
                            </button>
                        </div>
                      </div><!-- /.col-md-2 -->
                  </div><!-- /.row -->
 
                  <div class="row ">
                      <div class="col-md-6 form-group ">
                        <div class=" {{ $errors->has('filter_start_date') ? 'has-error' : ''}}">
                            {!! Form::label('filter_start_date', 'วันที่บันทึก'.' :', ['class' => 'col-md-3 control-label text-right ']) !!}
                            <div class="col-md-9">
                              <div class="input-daterange input-group" id="date-range">
                                {!! Form::text('filter_start_date', null, ['class' => 'form-control','id'=>'filter_start_date']) !!}
                                <span class="input-group-addon bg-info b-0 text-white"> ถึง </span>
                                {!! Form::text('filter_end_date', null, ['class' => 'form-control','id'=>'filter_end_date']) !!}
                              </div>
                            </div>
                        </div>
                      </div><!-- /.col-md-4  -->
                  </div><!-- /.row -->


    
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="myTable">
                            <thead>
                            <tr>
                                <th class="text-center" width="1%">#</th>
                                <th class="text-center" width="10%">เลขที่คำขอ</th>
                                <th class="text-center" width="10%">คณะผู้ตรวจประเมิน</th>
                                <th class="text-center" width="10%">วันที่ตรวจประเมิน</th>
                                <th class="text-center" width="10%">สถานะ</th>
                                <th class="text-center" width="10%">วันที่บันทึก</th>
                                <th class="text-center" width="10%">ผู้บันทึก</th>
                                <th class="text-center" width="10%">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
           
 



                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
<script src="{{asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/components/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/components/datatables/dataTables.bootstrap.js')}}"></script>
   <!-- input calendar thai -->
   <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
   <!-- thai extension -->
   <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}"></script>
   <script src="{{ asset('plugins/components/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
    <script>
        $(document).ready(function () {
            //ช่วงวันที่
            jQuery('#date-range').datepicker({
              toggleActive: true,
              language:'th-th',
              format: 'dd/mm/yyyy',
            });

            @if(\Session::has('flash_message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('flash_message')}}',
                loaderBg: '#70b7d6',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif

                        var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: '{!! url('/certificate/auditor-cbs/data_list') !!}',
                    data: function (d) {
                      
                        d.filter_search = $('#filter_search').val();
                        d.filter_certificate_no = $('#filter_certificate_no').val();
                        d.filter_status_id = $('#filter_status_id').val();
                        d.filter_start_date = $('#filter_start_date').val();
                        d.filter_end_date = $('#filter_end_date').val();
                    }
                },
                columns: [
                    { data: 'DT_Row_Index', searchable: false, orderable: false},
                    { data: 'reference_refno', name: 'reference_refno' },
                    { data: 'auditor', name: 'auditor' },
                    { data: 'date_title', name: 'date_title' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'action', name: 'action' }
                ],
                columnDefs: [
                    { className: "text-center", targets:[0,-1] }
                ],
                fnDrawCallback: function() {
                    $('#myTable_length').find('.totalrec').remove();
                    var el = ' <span class=" totalrec" style="color:green;"><b>(ทั้งหมด '+ Comma(table.page.info().recordsTotal) +' รายการ)</b></span>';
                    $('#myTable_length').append(el);
                    $('#myTable tbody').find('.dataTables_empty').addClass('text-center');
                }
            });



            $( "#button_search" ).click(function() {
                 table.draw();
            });

            $( "#filter_clear" ).click(function() {
              $('#filter_search').val('');
              $('#filter_certificate_no').val('').select2();
              $('#filter_status_id').val('').select2();
              $('#filter_start_date').val('');
              $('#filter_end_date').val('');
              table.draw();
 
           });
 
           


        });

 
       
        function Comma(Num)
        {
            Num += '';
            Num = Num.replace(/,/g, '');

            x = Num.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
            return x1 + x2;
        }

    </script>

@endpush
