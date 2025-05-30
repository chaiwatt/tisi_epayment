@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">รายละเอียดสาขาการทดสอบ {{ $test_branch->id }}</h3>
                    @can('view-'.str_slug('test_branch'))
                        <a class="btn btn-success pull-right" href="{{ url('/bcertify/test_branch') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> กลับ
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                              <tr>
                                  <th>ID</th>
                                  <td>{{ $test_branch->id }}</td>
                              </tr>
                              <tr>
                                <th> ชื่อสาขาการทดสอบ (TH): </th>
                                <td> {{ $test_branch->title }} </td>
                              </tr>
                              <tr>
                                <th> ชื่อสาขาการทดสอบ (EN): </th>
                                <td> {{ $test_branch->title_en }} </td>
                              </tr>
                              <tr>
                                <th> มาตรฐาน: </th>
                                <td> {{ $test_branch->formula->title }} </td>
                              </tr>
                              <tr>
                                <th> สถานะ </th>
                                <td> {!! $test_branch->state=='1'?'<span class="label label-success">เปิดใช้งาน</span>':'<span class="label label-danger">ปิดใช้งาน</span>' !!} </td>
                              </tr>
                              <tr>
                                <th> ผู้สร้าง </th>
                                <td> {{ $test_branch->createdName }} </td>
                              </tr>
                              <tr>
                                <th> วันเวลาที่สร้าง </th>
                                <td> {{ HP::DateTimeThai($test_branch->created_at) }} </td>
                              </tr>
                              <tr>
                                <th> ผู้แก้ไข </th>
                                <td> {{ $test_branch->updatedName }} </td>
                              </tr>
                              <tr>
                                <th> วันเวลาที่แก้ไข </th>
                                <td> {{ HP::DateTimeThai($test_branch->updated_at) }} </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
