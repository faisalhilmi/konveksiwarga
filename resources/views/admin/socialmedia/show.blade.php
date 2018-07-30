@extends('layouts.layout')

@section('page_header')
    @parent
    Social Media
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.socialmedia.index') !!}"> Social Media</a></li>
        <li class="active">Show</li>
</ol>
@endsection

@section('content')
    <section class="content-header">
    <h1>
        List Social Media
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                  <h1>#{{ $socmed->type }}</h1>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                          <th width="30%">Platform</th>
                          <td>{{ $socmed->type }}</td>
                        </tr>
                        <tr>
                          <th>URL</th>
                          <td>{{ $socmed->address }}</td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        <a href="{!! route('admin.socialmedia.index')  !!}"><button class="btn btn-primary">Kembali</button></a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('script')
    {!! Html::script('plugins/datatables/1.10.10/js/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/1.10.10/js/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
      $(function () {
        $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin.socialmedia.getdata') !!}",
            columns: [
                { data: "title" },
                { data: "active" },
                { data: "description" },
                { data: "action", orderable: false, sClass: "text-center" },
            ]
        });
      });
    </script>
@endsection

@section('head')
    {!! Html::style('plugins/datatables/1.10.10/css/dataTables.bootstrap.css') !!}
@stop