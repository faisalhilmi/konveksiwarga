@extends('layouts.layout')

@section('page_header')
@parent
    Recent Works
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.recentworks.index') !!}"> Portfolio</a></li>
        <li class="active">Add</li>
</ol>
@endsection

@section('content')
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Portfolio</h3>
                </div>
                {!! Form::open(['route' => 'admin.recentworks.store', 'class' => 'form-horizontal', "files"=>"true"]) !!}
                {!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div id="hide">
                                {!! Html::image('packages/images/noimage.gif','',["style"=>"width:100%;"]) !!}
                            </div>
                            <div id="image_preview_create"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Title</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="title" maxlength="100" required>
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Image</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="image" id="image" required>
                                    <span id="helpBlock" class="help-block"><i>Format Gambar [JPG/PNG]</i></span>
                                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Description</label>
                                <div class="col-sm-6">
                                    <textarea name="description" name="description" class="form-control"></textarea>
                                    <!-- <input type="text" class="form-control" name="description" required> -->
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('alt') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Alt</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="alt" maxlength="100">
                                    {!! $errors->first('alt', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('active', 'TRUE', FALSE) !!} Activate
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        {!! Form::submit('Create', ["class"=>"btn btn-success"]) !!}
                        <a href="{!! route('admin.recentworks.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
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