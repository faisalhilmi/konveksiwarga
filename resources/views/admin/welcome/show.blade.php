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
                {!! Form::open(['route' => 'admin.welcome.store', 'class' => 'form-horizontal', "files"=>"true"]) !!}
                {!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <table class="table table-bordered">
                        <tr>
                          <th width="30%">Title</th>
                          <td>{{ $welcome->title }}</td>
                        </tr>
                        <tr>
                          <th>Content</th>
                          <td>{{ $welcome->content }}</td>
                        </tr>
                    </table>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
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