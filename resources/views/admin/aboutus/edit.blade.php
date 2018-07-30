@extends('layouts.layout')

@section('page_header')
@parent
    Client
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.socialmedia.index') !!}"> Client</a></li>
        <li class="active">Edit</li>
</ol>
@endsection

@section('content')
  <section class="content-header">
	<h1>
		{!! trans('form.create_new') !!} Client
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{!! trans('form.form_create', ['name'=>'Client']) !!}</h3>
				</div>
				{!! Form::model($socmed, [
				'method' => 'PATCH',
				'route' => ['admin.socialmedia.update', $socmed->id],
				'class' => 'form-horizontal',
				"files"=>"true"
				]) !!}
				{!! Form::token(); !!}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
								<label class="control-label col-sm-3">Platform</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="type" value="{{ $socmed->type }}" disabled="">
									{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
							<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
								<label class="control-label col-sm-3">URL</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="address" value="{{ $socmed->address }}">
									{!! $errors->first('address', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="box-footer">
					<div class="col-sm-offset-5">
						{!! Form::submit('Edit', ["class"=>"btn btn-success"]) !!}
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