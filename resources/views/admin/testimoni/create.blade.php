@extends('layouts.layout')

@section('page_header')
@parent
    Testimoni
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.testimoni.index') !!}"> Testimoni</a></li>
        <li class="active">Add</li>
</ol>
@endsection

@section('content')
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Testimoni</h3>
                </div>
                {!! Form::open(['route' => 'admin.testimoni.store', 'class' => 'form-horizontal', "files"=>"true"]) !!}
                {!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Author</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="author" maxlength="100" required>
                                    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Company</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="company" maxlength="100" required>
                                    <!-- <input type="text" class="form-control" name="company" required> -->
                                    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                             <div class="form-group {{ $errors->has('testimoni') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Testimoni</label>
                                <div class="col-sm-6">
                                    <textarea name="testi" name="testi" class="form-control"></textarea>
                                    <!-- <input type="text" class="form-control" name="testimoni" required> -->
                                    {!! $errors->first('testimoni', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        {!! Form::submit('Create', ["class"=>"btn btn-success"]) !!}
                        <a href="{!! route('admin.testimoni.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
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