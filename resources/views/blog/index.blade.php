@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>

@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">ข่าวประชาสัมพันธ์ </h3>
                    @can('add-blog')
                        <a class="btn btn-success pull-right" href="{{url('blog/create')}}">
                          <i class="icon-plus"></i> เพิ่มข่าว
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อข่าว</th>
                                        <th>จำนวนความคิดเห็น</th>
                                        <th>สร้างเมื่อ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blogs as $key=>$blog)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->comments->count() }}</td>
                                            <td>{{ $blog->created_at->diffForHumans() }}</td>
                                            <th>
                                                @can('view-blog')
                                                    <a href="{{ url('blog/view/'.$blog->id) }}">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fa fa-eye" aria-hidden="true"></i> ดู
                                                        </button>
                                                    </a>&nbsp;&nbsp;
                                                @endcan

                                                @can('edit-blog')
                                                    <a class="btn btn-info btn-sm"
                                                       href="{{url('blog/edit/'.$blog->id)}}">
                                                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                                                    </a>&nbsp;&nbsp;
                                                @endcan

                                                @can('delete-blog')
                                                    <a class="delete btn btn-danger btn-sm"
                                                       href="{{url('blog/delete/'.$blog->id)}}">
                                                       <i class="fa fa-trash-o"></i> ลบ
                                                    </a>
                                                @endcan

                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->

    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                if (confirm('Are you sure want to delete?')) {
                }
                else {
                    return false;
                }
            });
            @if(\Session::has('success'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#70b7d6',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @elseif(\Session::has('error'))
            $.toast({
                heading: 'Error!',
                position: 'top-center',
                text: '{{session()->get('error')}}',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        });

    </script>

@endpush
