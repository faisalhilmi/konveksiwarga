@extends('layouts.layout')

@section('page_header')
    @parent
    Client
@endsection

@section('breadcumbs')
<ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="{!! route('admin.client.index') !!}"> Client</a></li>
        <li class="active">Show</li>
</ol>
@endsection

@section('content')
    <section class="content-header">
    <h1>
        List Client
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                  <h1>#{{ $client->title }}</h1>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                          <th width="30%">Judul</th>
                          <td>{{ $client->title }}</td>
                        </tr>
                        <tr>
                          <th>Gambar</th>
                          <td><img src="{{ asset('/images/client/'. $client->image) }}" height="100px" width="100px"></td>
                        </tr>
                        <tr>
                          <th>Deskripsi</th>
                          <td>{{ $client->description }}</td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td>{{ $client->active == 'TRUE' ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-5">
                        <a href="{!! route('admin.client.index')  !!}"><button class="btn btn-primary">Kembali</button></a>
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
            ajax: "{!! route('admin.client.getdata') !!}",
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