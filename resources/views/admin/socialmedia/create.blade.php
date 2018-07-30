@extends('layouts.layout')

@section('page_header')
@parent
    Social Media
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.socialmedia.index') !!}"> Social Media</a></li>
        <li class="active">Add</li>
</ol>
@endsection

@section('content')
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Social Media</h3>
                </div>
                {!! Form::open(['route' => 'admin.socialmedia.store', 'class' => 'form-horizontal', "files"=>"true"]) !!}
                {!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">URL</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" maxlength="100">
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Platform</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="type" maxlength="100" required>
                                    <!-- <input type="text" class="form-control" name="type" required> -->
                                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        {!! Form::submit('Create', ["class"=>"btn btn-success"]) !!}
                        <a href="{!! route('admin.socialmedia.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
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
@endsection