@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">ดูการแจ้งข้อมูลอื่นๆ</h3>
                    @can('view-'.str_slug('other'))
                        <a class="btn btn-success pull-right" href="{{url('/esurv/other')}}">
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

                    {!! Form::open(['url' => '/esurv/other', 'class' => 'form-horizontal', 'files' => true]) !!}

                    @include ('esurv.other.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
