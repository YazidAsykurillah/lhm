@extends('adminlte::page')

@section('title', 'Tabungan')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Tabungan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Tabungan</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Transaksi Tabungan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-xs btn-primary" title="Upload Tabungan">
              <i class="fas fa-plus"></i> Upload Tabungan
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table-saving-transaction">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th>Jumlah</th>
                    <th>Tanggal Upload</th>
                    <th>Bukti Resi</th>
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
        var dT = $('#table-saving-transaction').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('saving-transaction/datatables') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className:'text-center',
                    searchable:false,
                    orderable:false
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'transaction_receipt',
                    name: 'transaction_receipt'
                },
                {
                    data: 'is_confirmed',
                    name: 'is_confirmed',
                    render:function(data, type, row, meta){
                        let is_confirmed='';
                        if(data == true){
                            is_confirmed = 'Terkonfirmasi';
                        }else{
                            is_confirmed='Belum dikonfirmasi';
                        }
                        return is_confirmed;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render:function(data, type, row, meta){
                        let action ='';
                            action+='<a class="btn btn-default btn-xs btn-primary" title="Lihat" href="/umrah-batch/'+row.id+'">';
                            action+=    '<i class="fas fa-eye"></i> ';
                            action+='</a>';

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
