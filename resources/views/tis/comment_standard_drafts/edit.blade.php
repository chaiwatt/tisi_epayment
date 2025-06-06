@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">แสดงความเห็นในร่างมาตรฐาน #{{ $public_draft->id }}</h3>
                    @can('view-'.str_slug('comment-standard-drafts'))
                        {{-- <a class="btn btn-success pull-right" href="{{ url('/tis/comment_standard_drafts') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> กลับ
                        </a> --}}
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

                    {!! Form::model($public_draft, [
                        'method' => 'PATCH',
                        'url' => ['/tis/comment_standard_drafts/save', $public_draft->token],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('tis.comment_standard_drafts.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
