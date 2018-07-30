@extends('layouts.layout')

@section('page_header')
    @parent
    Testimoni
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active">Testimoni</li>
</ol>
@endsection

@section('content')
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List Testimoni</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Testimoni
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Company</th>
                            <th>Testimoni</th>
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
            ajax: "{!! route('admin.testimoni.getdata') !!}",
            columns: [
                { data: "author" },
                { data: "company" },
                { data: "testi" },
                { data: "action", orderable: false, sClass: "text-center" },
            ]
        });
      });
    </script>
@endsection

@section('head')
    {!! Html::style('plugins/datatables/1.10.10/css/dataTables.bootstrap.css') !!}
@stop