@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">เพิ่มขอบข่ายการรับรอง</h3>
                    @can('view-'.str_slug('certification_scope'))
                        <a class="btn btn-success pull-right" href="{{url('/bcertify/certification_scope')}}">
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

                    {!! Form::open(['url' => '/bcertify/certification_scope', 'class' => 'form-horizontal', 'files' => true]) !!}

                    @include ('bcertify.certification_scope.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
