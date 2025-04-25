@extends('layouts.master')

@push('css')

<style>

  .label-filter{
    margin-top: 7px;
  }
  /*
	Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
	*/
	@media
	  only screen
    and (max-width: 760px), (min-device-width: 768px)
    and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr {
			display: block;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    tr {
      margin: 0 0 1rem 0;
    }

    tr:nth-child(odd) {
      background: #eee;
    }

		td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			/* Now like a table header */
			/*position: absolute;*/
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}

		/*
		Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
		*/
    td:nth-of-type(1):before { content: "No.:"; }
    td:nth-of-type(2):before { content: "เลือก:"; }
    td:nth-of-type(3):before { content: "เลขที่ยกเลิก:"; }
    td:nth-of-type(4):before { content: "มาตรฐาน:"; }
    td:nth-of-type(5):before { content: "เลขที่ใบอนุญาต:"; }
    td:nth-of-type(6):before { content: "วันที่ยกเลิก:"; }
    td:nth-of-type(7):before { content: "เหตุผลที่ยกเลิก:"; }
    td:nth-of-type(8):before { content: "วันที่บันทึก:"; }
    td:nth-of-type(9):before { content: "ผู้บันทึก:"; }
    td:nth-of-type(10):before { content: "จัดการ:"; }

	}
</style>

@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">การยกเลิกใบอนุญาต</h3>

                    <div class="pull-right">

                      @can('add-'.str_slug('license_cancel'))
                          <a class="btn btn-success btn-sm waves-effect waves-light" href="{{ url('/esurv/license_cancel/create') }}">
                            <span class="btn-label"><i class="fa fa-plus"></i></span><b>เพิ่ม</b>
                          </a>
                      @endcan

                      @can('delete-'.str_slug('license_cancel'))
                          <a class="btn btn-danger btn-sm waves-effect waves-light" href="#" onclick="Delete();">
                            <span class="btn-label"><i class="fa fa-trash-o"></i></span><b>ลบ</b>
                          </a>
                      @endcan

                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    {!! Form::model($filter, ['url' => '/esurv/license_cancel', 'method' => 'get', 'id' => 'myFilter']) !!}

											<div class="col-md-3">
												  {!! Form::label('perPage', 'Show:', ['class' => 'col-md-3 control-label label-filter']) !!}
												  <div class="col-md-9">
														{!! Form::select('perPage', ['10'=>'10', '20'=>'20', '50'=>'50', '100'=>'100', '500'=>'500'], null, ['class' => 'form-control', 'onchange'=>'this.form.submit()']); !!}
												  </div>
											</div>

											<div class="col-md-3">
												  {!! Form::label('title', 'สถานะ:', ['class' => 'col-md-3 control-label label-filter']) !!}
												  <div class="col-md-9">
														{!! Form::select('filter_state', ['1'=>'เปิดใช้งาน', '0'=>'ปิดใช้งาน'], null, ['class' => 'form-control', 'placeholder'=>'-เลือกสถานะ-', 'onchange'=>'this.form.submit()']); !!}
												  </div>
											</div>

                      <div class="col-md-6">
                          {!! Form::label('filter_tb3_Tisno', 'มาตรฐาน:', ['class' => 'col-md-3 control-label label-filter']) !!}
                          <div class="col-md-9">
                            {!! Form::select('filter_tb3_Tisno', HP::TisList(), null, ['class' => 'form-control', 'placeholder'=>'-เลือกมาตรฐาน-', 'onchange'=>'this.form.submit()']); !!}
                          </div>
                      </div>

											<input type="hidden" name="sort" value="{{ Request::get('sort') }}" />
											<input type="hidden" name="direction" value="{{ Request::get('direction') }}" />

										{!! Form::close() !!}

                    <div class="clearfix"></div>

                    <div class="table-responsive">

                      {!! Form::open(['url' => '/esurv/license_cancel/multiple', 'method' => 'delete', 'id' => 'myForm', 'class'=>'hide']) !!}

                      {!! Form::close() !!}

                      {!! Form::open(['url' => '/esurv/license_cancel/update-state', 'method' => 'put', 'id' => 'myFormState', 'class'=>'hide']) !!}
                        <input type="hidden" name="state" id="state" />
                      {!! Form::close() !!}

                        <table class="table table-borderless" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" id="checkall"></th>
                                <th>@sortablelink('id', 'เลขที่ยกเลิก')</th>
                                <th>@sortablelink('tb3_Tisno', 'มาตรฐาน')</th>
                                <th>เลขที่ใบอนุญาต</th>
                                <th>@sortablelink('cancel_date', 'วันที่ยกเลิก')</th>
                                <th>@sortablelink('reason_type', 'เหตุผลที่ยกเลิก')</th>
																<th>@sortablelink('created_at', 'วันที่บันทึก')</th>
																<th>@sortablelink('created_by', 'ผู้บันทึก')</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($license_cancel as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td><input type="checkbox" name="cb[]" class="cb" value="{{ $item->id }}"></td>
                                    <td>{{ $item->cancel_no }}</td>
                                    <td>{{ 'มอก. '.$item->tb3_Tisno }}</td>
                                    <td>
                                      @foreach ($item->license_list as $license)
                                        <div>{{ $license->tbl_licenseNo }}</div>
                                      @endforeach
                                    </td>
                                    <td>{{ HP::DateThai($item->cancel_date) }}</td>
                                    <td>{{ HP::ReasonTypes()[$item->reason_type] }}</td>
                                    <td>{{ HP::DateThai($item->created_at) }}</td>
                                    <td>{{ $item->createdName }}</td>
                                    <td>
                                        @can('view-'.str_slug('license_cancel'))
                                            <a href="{{ url('/esurv/license_cancel/' . $item->id) }}"
                                               title="View license_cancel" class="btn btn-info btn-xs">
                                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('license_cancel'))
                                            <a href="{{ url('/esurv/license_cancel/' . $item->id . '/edit') }}"
                                               title="Edit license_cancel" class="btn btn-primary btn-xs">
                                                  <i class="fa fa-pencil-square-o" aria-hidden="true"> </i>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('license_cancel'))
                                            {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'url' => ['/esurv/license_cancel', $item->id],
                                                            'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete license_cancel',
                                                    'onclick'=>'return confirm("ยืนยันการลบข้อมูล?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        @endcan

                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>

                        <div class="pagination-wrapper">
                          {!!
                              $license_cancel->appends(['search' => Request::get('search'),
                                                      'sort' => Request::get('sort'),
                                                      'direction' => Request::get('direction'),
                                                      'perPage' => Request::get('perPage'),
                                                      'filter_state' => Request::get('filter_state')
                                                     ])->render()
                          !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script>
        $(document).ready(function () {

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

            //เลือกทั้งหมด
            $('#checkall').change(function(event) {

              if($(this).prop('checked')){//เลือกทั้งหมด
                $('#myTable').find('input.cb').prop('checked', true);
              }else{
                $('#myTable').find('input.cb').prop('checked', false);
              }

            });

        });

        function Delete(){

          if($('#myTable').find('input.cb:checked').length > 0){//ถ้าเลือกแล้ว
            if(confirm_delete()){
              $('#myTable').find('input.cb:checked').appendTo("#myForm");
              $('#myForm').submit();
            }
          }else{//ยังไม่ได้เลือก
            alert("กรุณาเลือกข้อมูลที่ต้องการลบ");
          }

        }

        function confirm_delete() {
            return confirm("ยืนยันการลบข้อมูล?");
        }

        function UpdateState(state){

          if($('#myTable').find('input.cb:checked').length > 0){//ถ้าเลือกแล้ว
              $('#myTable').find('input.cb:checked').appendTo("#myFormState");
              $('#state').val(state);
              $('#myFormState').submit();
          }else{//ยังไม่ได้เลือก
            if(state=='1'){
              alert("กรุณาเลือกข้อมูลที่ต้องการเปิด");
            }else{
              alert("กรุณาเลือกข้อมูลที่ต้องการปิด");
            }
          }

        }

    </script>

@endpush
