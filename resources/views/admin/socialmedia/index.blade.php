@extends('layouts.layout')

@section('page_header')
    @parent
    Social Media
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active">Social Media</li>
</ol>
@endsection

@section('content')
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List Social Media</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.socialmedia.create') }}" class="btn btn-primary" style="visibility: hidden;">
                        <i class="fa fa-plus"></i> Add Social Media
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Platform</th>
                            <th>URL</th>
                            <th width="90">Action</th>
                        </tr>
                    </thead>
                </table>
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
                { data: "type" },
                { data: "address" },
                { data: "action", orderable: false, sClass: "text-center" },
            ]
        });
      });
    </script>
@endsection

@section('head')
    {!! Html::style('plugins/datatables/1.10.10/css/dataTables.bootstrap.css') !!}
@stop