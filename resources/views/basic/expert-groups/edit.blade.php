@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">แก้ไข ข้อมูลพื้นฐานความเชี่ยวชาญ #{{ $expertgroup->id }}</h3>
                    @can('view-'.str_slug('expertgroups'))
                        <a class="btn btn-success pull-right" href="{{ url('/basic/expert-groups') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> กลับ
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

                    {!! Form::model($expertgroup, [
                        'method' => 'PATCH',
                        'url' => ['/basic/expert-groups', $expertgroup->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('basic.expert-groups.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
