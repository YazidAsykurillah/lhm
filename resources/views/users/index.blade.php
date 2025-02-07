@extends('adminlte::page')

@section('title', 'User :: User List')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('/users')}}">
                        Users
                    </a>
                </li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User List</h3>
        <div class="card-tools">
            <a href="/users/create" class="btn btn-sm btn-default" title="Create new user">Create</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table-users">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Roles</th>
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
                {data: 'roles', name: 'roles.name',render:function(data, type, row, meta){
                    let roles_template = '';
                    if(row.roles.length >0){
                        $.each( row.roles, function( key, value ){
                            roles_template+='<span class="badge bg-info">';
                            roles_template+=    value.name;
                            roles_template+='</span>&nbsp;';
                        });
                    }
                    return roles_template;
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+='<a class="btn btn-default btn-xs btn-edit" title="Edit" href="/users/'+row.id+'/edit">';
                        action+=    '<i class="fas fa-edit"></i>';
                        action+='</a>';
                        action+='&nbsp;';
                        action+='<button class="btn btn-default btn-xs btn-delete" title="Delete">';
                        action+=    '<i class="fas fa-trash"></i>';
                        action+='</button>';
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
