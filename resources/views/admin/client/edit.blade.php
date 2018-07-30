@extends('layouts.layout')

@section('page_header')
@parent
    Client
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.client.index') !!}"> Client</a></li>
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
				{!! Form::model($client, [
				'method' => 'PATCH',
				'route' => ['admin.client.update', $client->id],
				'class' => 'form-horizontal',
				"files"=>"true"
				]) !!}
				{!! Form::token(); !!}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 col-xs-12">
							<div id="hide">
								{!! Html::image('images/Client/'.$client->image,'',["style"=>"width:100%;"]) !!}
							</div>
							<div id="image_preview"></div>
						</div>
						<div class="col-md-8">
							<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
								<label class="control-label col-sm-3">Image</label>
								<div class="col-sm-6">
									<input type="file" class="form-control" name="image" id="image">
									{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
							<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
								<label class="control-label col-sm-3">Title</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="title" value="{{ $client->title }}" required>
									{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
							<div class="form-group {{ $errors->has('alt') ? 'has-error' : '' }}">
								<label class="control-label col-sm-3">alt</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="alt" value="{{ $client->alt }}">
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
						{!! Form::submit('Edit', ["class"=>"btn btn-success"]) !!}
						<a href="{!! route('admin.client.index') !!}" class="btn btn-default">{!! 'Cancel' !!}</a>
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