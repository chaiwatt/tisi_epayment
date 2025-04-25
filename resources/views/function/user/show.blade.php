@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">แก้ไขขั้นตอนการดำเนินงาน #{{ $data->id }}</h3>
              
                        <a class="btn btn-success pull-right" href="{{ url('/page/send-mails/infomation') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> กลับ
                        </a>
    
                    <div class="clearfix"></div>
                    <hr>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($data, [
                        'method' => 'PATCH',
                        'url' => ['/page/send-mails/infomation', $data->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('function.user.form-mail')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection