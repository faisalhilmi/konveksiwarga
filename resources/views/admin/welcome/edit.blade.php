@extends('layouts.layout')

@section('page_header')
@parent
    Add Post
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.welcome.index') !!}"> Welcome Page</a></li>
        <li class="active">Add</li>
</ol>
@endsection

@section('content')
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Post</h3>
                </div>
                {!! Form::model($welcome, [
				'method' => 'PATCH',
				'route' => ['admin.welcome.update', $welcome->id],
				'class' => 'form-horizontal',
				"files"=>"true"
				]) !!}
				{!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" maxlength="100" value="{{ $welcome->title }}" required>
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('konten') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">Content</label>
                                <div class="col-sm-8">
                                    <textarea id="konten" class="form-control" name="konten" rows="10" cols="50">{{ $welcome->content }}</textarea>
                                    <!-- <input type="text" class="form-control" name="konten" required> -->
                                    {!! $errors->first('konten', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" hidden="" value="welcome" name="category">
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-2">Tags</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tags" value="{{ $welcome->tags }}" data-role="tagsinput" />
                                    {!! $errors->first('tags', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        {!! Form::submit('Create', ["class"=>"btn btn-success"]) !!}
                        <a href="{!! route('admin.welcome.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{!! url('plugins/js/admin.js') !!}"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
<script src="{{asset('assets/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput-angular.min.js')}}"></script>
<script src="{{asset('assets/bootstrap-tagsinput-latest/assets/app.js')}}"></script>
<script src="{{asset('assets/bootstrap-tagsinput-latest/assets/app_bs3.js')}}"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
   var konten = document.getElementById("konten");
     CKEDITOR.replace(konten,{
     language:'en-gb'
   });
   CKEDITOR.config.allowedContent = true;
</script>
@endsection