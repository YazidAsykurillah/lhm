@extends('adminlte::page')

@section('title', 'Daftar Batch')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Daftar Batch</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Daftar Batch</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jumlah Batch Terdaftar</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table-umrah-batch">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:15%;">Kode Batch</th>
                    <th style="width:15%;">Tanggal Berangkat</th>
                    <th style="width:15%;">Harga Dasar</th>
                    <th>Keterangan</th>
                    <th style="width:10%;">Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="card-footer">
        <div id="data-table-button-tools" class=""></div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var dT = $('#table-umrah-batch').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('umrah-batch/datatables') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className:'text-center',
                    searchable:false,
                    orderable:false
                },
                {
                    data: 'code_batch',
                    name: 'code_batch'},
                {
                    data: 'departure_schedule',
                    name: 'departure_schedule'
                },
                {
                    data: 'basic_price', name: 'basic_price'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'availability',
                    name: 'availability'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render:function(data, type, row, meta){
                        let action ='';
                            if(row.availability == 'available'){

                                action+='<a class="btn btn-default btn-xs btn-primary" title="Lihat" href="/umrah-batch/'+row.id+'">';
                                action+=    '<i class="fas fa-eye"></i> ';
                                action+='</a>';

                                action+='<a class="btn btn-default btn-xs btn-edit" title="Edit" href="/umrah-batch/'+row.id+'/edit">';
                                action+=    '<i class="fas fa-edit"></i>';   
                            }
                            action+='</a>';
                        return action;
                    }
                },
            ],
            order: [
                [ 2, "desc" ],
            ],
        });
    });
</script>
@endsection
