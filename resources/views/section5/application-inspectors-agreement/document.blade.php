@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">บันทึกเอกสารขึ้นทะเบียนผู้ตรวจ และผู้ประเมินของผู้ตรวจสอบการทำผลิตภัณฑ์อุตสาหกรรม (IB) #{{ $application_inspectors->id }}</h3>
                        <a class="btn btn-success pull-right" href="{{ url('/section5/application-inspectors-agreement') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> กลับ</a>
  
                    <div class="clearfix"></div>
                    <hr>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($application_inspectors, [
                        'method' => 'PATCH',
                        'url' => ['/section5/application-inspectors-agreement/document-save', $application_inspectors->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}


                    @include ('section5.application-inspectors-agreement.form', ['submitButtonText' => 'Update'])
      
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection