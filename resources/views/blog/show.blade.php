@extends('layouts.master')

@push('css')
    <style>
        .blog-detail-content p img{
            margin: 2px;
        }
        .label{
            margin-bottom: 5px;
            display: inline-block;
            border-radius: 0!important;
            font-size: 0.9em;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @can('view-blog')
                        <div class="text-left">
                            <h1 class="box-title">{{$blog->title}}</h1>
                            <span class="label label-primary square"> ผู้เขียน : {!! $blog->author->reg_fname.' '.$blog->author->reg_lname !!}</span>
                            <span class="label label-warning square">เขียนเมื่อ :  {!!  $blog->created_at->diffforhumans() !!}</span>

                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="row">
                            <div class="the-box no-border blog-detail-content col-md-12">
                                <p>
                                </p>
                                <p class="text-justify">
                                    {!! $blog->content !!}
                                </p>

                                @if($tags != null)
                                    <hr>
                                    <p><strong>แท็ก : </strong> {!! $tags !!}</p>
                                @endif


                                @if(count($comments) > 0)
                                    <hr>
                                    <p>
                                        <span class="label label-success square">ความคิดเห็น</span>
                                    </p>
                                    <ul class="media-list media-sm media-dotted recent-post">
                                        @foreach($comments as $comment)
                                            <li class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        <a href="{!! $comment->website !!}">{!! $comment->name !!}</a>
                                                    </h4>
                                                    <p>
                                                        {!! $comment->comment!!}
                                                    </p>
                                                    <p class="text-danger">
                                                        <small> {!! $comment->created_at->diffforhumans() !!}</small>
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <hr>
                                <p class="form-group">
                                    <span class="label label-info square">ความคิดเห็นของคุณ</span>
                                </p>

                                <form method="post" class="bf" enctype="multipart/form-data" action="{{url('blog/'.$blog->id.'/storecomment')}}">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="form-group m-b-0 col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="ชื่อ">
                                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                        </div>
                                        <div class="form-group m-b-0 col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="อีเมล">
                                            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-0 {{ $errors->has('comment') ? 'has-error' : '' }}">
                                        <textarea id="comment" class="form-control no-resize" placeholder="ความคิดเห็นของคุณ" name="comment">{{old('comment')}}</textarea>
                                        <span class="help-block">{{ $errors->first('comment', ':message') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                          <i class="fa fa-comment"></i> ส่งความคิดเห็น
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    @else
                        <h1 align="center">You are not authorised to View this page</h1>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
