@extends('layouts.layout')

@section('page_header')
@parent
    About Us
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.aboutus.index') !!}"> About Us</a></li>
        <li class="active">Add</li>
</ol>
@endsection

@section('content')
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add About Us</h3>
                </div>
                {!! Form::open(['route' => 'admin.aboutus.store', 'class' => 'form-horizontal', "files"=>"true"]) !!}
                {!! Form::token(); !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Type</label>
                                <div class="col-sm-6">
                                    <select name="type" class="form-control">  
 <option value="">Silahkan Pilih</option>  
 <option value="About">About Us</option>  
 <option value="Location">Location</option>  
 <option value="Email">Email</option>  
 <option value="Phonenumber">Phonenumber</option>  
 </select>   
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="control-label col-sm-3">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="description" maxlength="100" required>
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
                        <a href="{!! route('admin.aboutus.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
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