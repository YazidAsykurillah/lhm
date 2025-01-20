@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Users</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table-users">
            <thead>
                <tr>
                    <th style="width:10%;">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
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
        var userDT = $('#table-users').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('user/datatables') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+='<a class="btn btn-default btn-xs btn-edit" title="Edit" href="/users/'+row.id+'/edit">';
                        action+=    '<i class="fas fa-edit"></i>';
                        action+='</a>';
                    return action;
                }},
            ],
            order: [
                [ 1, "asc" ],
            ],
        });
    });
</script>
@endsection
